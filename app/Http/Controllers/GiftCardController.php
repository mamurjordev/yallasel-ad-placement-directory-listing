<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use App\Models\Payment;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GiftCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('GiftCard/List', [
            'giftCards' => DB::table('gift_cards')->orderBy('id')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Inertia::setRootView('admin');
        return Inertia::render('GiftCard/Form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $code = "";
        for ($i = 0; $i < 10; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        if ($request->custom_code) {
            $code = $request->custom_code;
        }

        $type = $request->is_subscription == 1 ? 'subscription' : 'posts';

        GiftCard::create([
            'name' => $request->name,
            'code' => $code,
            'type' => $type,
            'post_count' => $request->post_amount,
            'days' => $request->subscription_length,
            'status' => $request->status
        ]);

        return redirect('/panel/giftcard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function show(GiftCard $giftCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function edit(GiftCard $giftcard)
    {
        Inertia::setRootView('admin');
        return Inertia::render('GiftCard/Form', [
            'giftcard' => $giftcard
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiftCard $giftcard)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $type = $request->is_subscription == 1 ? 'subscription' : 'posts';

        $giftcard->name = $request->name;
        $giftcard->type = $type;
        $giftcard->post_count = $request->post_amount;
        $giftcard->days = $request->subscription_length;
        $giftcard->status = $request->status;
        $giftcard->save();

        return redirect()->route('panel.giftcard.edit', $giftcard->id)->with('success', 'Gift Card updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GiftCard  $giftCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiftCard $giftcard)
    {
        $giftcard->delete();
        return Redirect::route('panel.giftcard.index');
    }


    public function redeem()
    {
        return Inertia::render('Payment/Redeem');
    }

    public function redeemSuccess(Request $request)
    {
        $payment = Payment::firstOrCreate([
            'user_id' => Auth::user()->id
        ]);

        $gift = $this->matchCode($request->code);
        if ($gift) {
            if ($gift->type == 'posts') {
                Payment::where('user_id', Auth::user()->id)->increment('allowed_posts', $gift->post_count);
            } elseif ($gift->type == 'subscription') {
                $payment->is_subscribed = 1;
                $payment->end_date = Carbon::parse($payment->end_date)->addDays($gift->days);
                $payment->save();
            }
            DB::table('user_redeem')->insert([
                'user_id' => Auth::user()->id,
                'code' => $request->code
            ]);
            return Inertia::render('Payment/RedeemSuccess');
        } else {
            return redirect()->back()->withErrors([
                'cancel' => 'Code redeem was unsuccessfull.'
            ]);
        }
    }

    public function matchCode($code)
    {
        $isUsed = DB::table('user_redeem')->where('user_id', Auth::user()->id)->where('code', $code)->first();
        if (!$isUsed) {
            $match = DB::table('gift_cards')->where('code', $code)->where('status', 'publish')->first();
            return $match ? $match : false;
        }
        return false;
    }

    public function statistics()
    {
        Inertia::setRootView('admin');
        $count =
            DB::table('user_redeem')
            ->select('code', DB::raw('count(user_id) as total'))
            ->groupBy('code')
            ->paginate(20);
        return Inertia::render('Statistics/GiftCard', [
            'user_redeems' => $count
        ]);
    }
}
