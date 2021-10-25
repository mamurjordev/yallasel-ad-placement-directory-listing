<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class WebViewController extends Controller
{
    public function package(Request $request)
    {
        return Inertia::render('webview/package', [
            'featurePackagesMonthly' => DB::table('payment_packages')
                ->where('is_subscription', 1)
                ->where('time_period', 'monthly')
                ->where('status', 'publish')->orderBy('sort_no')->limit(3)->get(),
            'featurePackagesYearly' => DB::table('payment_packages')
                ->where('is_subscription', 1)
                ->where('time_period', 'yearly')
                ->where('status', 'publish')->orderBy('sort_no')->limit(3)->get(),
            'buyPosts' => DB::table('payment_packages')->where('is_subscription', 0)->where('status', 'publish')->orderBy('post_amount')->get(),
            'bearer'=>$request->bearer
        ]);
    }

    public function chat(Request $request){
        if (!$request->bearer) {
            return response()->json(['success'=>false, 'message'=>'Require bearer token']);
        }
        $personalAccessToken = PersonalAccessToken::findToken($request->bearer);
        if (!$personalAccessToken) {
            return response()->json(['success'=>false, 'message'=>'incorrect bearer token']);
        }
        $user = $personalAccessToken->tokenable;
        Auth::login($user);

        $reciever = User::where('id', $request->u)->select('id', 'name', 'username', 'email', 'profile_photo')->first();

        return Inertia::render('webview/chat',[
            'reciever' => $reciever
        ]);
    }
}
