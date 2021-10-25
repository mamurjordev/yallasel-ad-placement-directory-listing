<?php

namespace App\Http\Controllers;

use App\Models\PaymentPackage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Payment/List', [
            'payments' => PaymentPackage::orderBy('id', 'DESC')->paginate(20),
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
        return Inertia::render('Payment/Create');
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
            'price' => 'required|max:6'
        ]);
        PaymentPackage::create([
            'name' => $request->name,
            'price' => $request->price,
            'is_subscription' => $request->is_subscription,
            'time_period' => $request->time_period,
            'subscription_length' => $request->subscription_length,
            'post_amount' => $request->post_amount,
            'feature' => $request->feature,
            'sort_no' => $request->sort_no,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect('/panel/payment_package');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentPackage  $paymentPackage
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentPackage $paymentPackage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentPackage  $paymentPackage
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentPackage $paymentPackage)
    {
        Inertia::setRootView('admin');
        return Inertia::render('Payment/Edit', [
            'paymentPackage' => $paymentPackage
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentPackage  $paymentPackage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentPackage $paymentPackage)
    {
        // dd($request);
        $paymentPackage->name = $request->name;
        $paymentPackage->price = $request->price;
        $paymentPackage->is_subscription = $request->is_subscription;
        $paymentPackage->subscription_length = $request->subscription_length;
        $paymentPackage->post_amount = $request->post_amount;
        $paymentPackage->feature = $request->feature;
        $paymentPackage->sort_no = $request->sort_no;
        $paymentPackage->description = $request->description;
        $paymentPackage->time_period = $request->time_period;
        $paymentPackage->status = $request->status;

        $paymentPackage->save();

        return redirect()->route('panel.payment_package.edit', $paymentPackage->id)->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentPackage  $paymentPackage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentPackage $paymentPackage)
    {
        $paymentPackage->delete();
        return redirect()->route('panel.giftcard.index');
    }
}
