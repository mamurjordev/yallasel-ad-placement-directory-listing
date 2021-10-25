<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;

class StripeController extends Controller
{
    public function handleGet()
    {
        return view('home');
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => 100 * 150,
            "currency" => "iqd",
            "source" => $request->stripeToken,
            "description" => "Making test payment."
        ]);

        $request->session()->flash('success', 'Payment has been successfully processed.');

        return back();
    }
}
