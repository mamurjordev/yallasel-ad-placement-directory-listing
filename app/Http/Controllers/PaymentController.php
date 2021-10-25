<?php

namespace App\Http\Controllers;

use App\Models\PackageLog;
use Carbon\Carbon;
use Stripe\Stripe;
use App\Models\Post;
use Inertia\Inertia;
use Omnipay\Omnipay;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PaymentPackage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\PersonalAccessToken;
use Stripe\Checkout\Session as checkout;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Admin/Payment/List', [
            'payments' => Payment::orderBy('id', 'DESC')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return Inertia::render('Payment/Package.vue', [
            'featurePackagesMonthly' => DB::table('payment_packages')
                ->where('is_subscription', 1)
                ->where('time_period', 'monthly')
                ->where('status', 'publish')->orderBy('sort_no')->limit(3)->get(),
            'featurePackagesYearly' => DB::table('payment_packages')
                ->where('is_subscription', 1)
                ->where('time_period', 'yearly')
                ->where('status', 'publish')->orderBy('sort_no')->limit(3)->get(),
            'buyPosts' => DB::table('payment_packages')->where('is_subscription', 0)->where('status', 'publish')->orderBy('post_amount')->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function boostAd(Request $request)
    {
        $price = DB::table('settings')->where('name', 'ad_boost_price')->first()->value;
        $postId = $request->post_id;
        $price = $price;
        $qty = $request->week;

        $response = $this->paypal($request, $price, $qty, $postId, 'boost-success', 'boost-cancel');
        return $response->getRedirectUrl();
    }
    public function check()
    {
        $postId = 1;
        $qty = 1;
        $post = Post::find($postId);
        $boostUntil = Carbon::parse($post->boost_until)->addDays($qty * 7);
        $post->boost_until = $boostUntil;
        $post->save();
        return redirect('/my-ads')->with([
            'success' => 'You have boosted your ad successfully'
        ]);
    }
    public function boostSuccess(Request $request)
    {
        // dd($request);
        $transaction = $this->paypalGateway()->completePurchase(array(
            'payerId'             => $request->PayerID,
            'transactionReference' => $request->paymentId,
        ));
        $response = $transaction->send();
        // dd($response);
        if (!$response->isSuccessful()) {
            return redirect('/payment/package')->withErrors([
                'cancel' => 'Your Payment was unsuccessfull.'
            ]);
        }

        $item = $response->getData()['transactions'][0]['item_list']['items'][0];
        $postId = $item['name'];
        $qty = $item['quantity'];

        $post = Post::find($postId);
        $boostUntil = Carbon::parse($post->boost_until)->addDays($qty * 7);
        $post->boost_until = $boostUntil;
        $post->save();
        return redirect('/my-ads')->with([
            'success' => 'You have boosted your ad successfully'
        ]);
    }
    public function boostCancel()
    {
        return redirect('/my-ads')->withErrors([
            'cancel' => 'Your Payment was unsuccessfull.'
        ]);
    }

    public function checkout(Request $request)
    {

        $package = PaymentPackage::find($request->packageId);

        if (!$package) return response()->json('false');

        $name = $package->name;
        $price = $package->price;
        $qty = $request->amount;

        $response = $this->paypal($request, $price, $qty, $package->id, 'paymentsuccess', 'paymenterror');

        return $response->getRedirectUrl();
    }
    public function checkoutApp(Request $request)
    {
        $personalAccessToken = PersonalAccessToken::findToken($request->bearer);
        $user = $personalAccessToken->tokenable;
        Auth()->login($user);

        $package = PaymentPackage::find($request->packageId);

        if (!$package) return response()->json('false');

        $name = $package->name;
        $price = $package->price;
        $qty = $request->amount;

        $response = $this->paypal($request, $price, $qty, $package->id, 'app-payment-success', 'app-payment-error');

        return $response->getRedirectUrl();
    }
    public function appSuccess(Request $request)
    {
        $transaction = $this->paypalGateway()->completePurchase(array(
            'payerId'             => $request->PayerID,
            'transactionReference' => $request->paymentId,
        ));
        $response = $transaction->send();
        // dd($response);
        if (!$response->isSuccessful()) {
            return redirect('/payment/package')->withErrors([
                'cancel' => 'Your Payment was unsuccessfull.'
            ]);
        }

        $item = $response->getData()['transactions'][0]['item_list']['items'][0];
        $packageId = $item['name'];
        $qty = $item['quantity'];

        $package = PaymentPackage::find($packageId);
        $payment = Payment::firstOrCreate([
            'user_id' => Auth::user()->id
        ]);

        $this->packageLog($payment->user_id, $packageId, $qty, $package->price);

        if ($package->is_subscription == 1) {
            $payment->is_subscribed = 1;
            $payment->start_date = $payment->start_date ? $payment->start_date : now();
            $payment->end_date = Carbon::parse($payment->end_date)->addDays($package->subscription_length * 30);

            $payment->save();
        } else {
            $payment->allowed_posts += $package->post_amount * $qty;
            $payment->save();
        }
        return response()->json([
            'success' => true,
            'message' => 'Payment done successfully',
            'payment' => $payment

        ]);
    }

    public function appCancel()
    {
        return response()->json([
            'success' => false,
            'message' => 'Payment was unsuccessful'
        ]);
    }


    public function paypal(Request $request, $price, $qty, $packageId, $returnUrl, $cancelUrl)
    {

        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $gateway->setTestMode(env('PAYPAL_TEST_MODE'));


        try {
            $response = $gateway->purchase(array(
                'amount' => $price * $qty,
                'currency' => env('PAYMENT_CURRENCY'),
                'returnUrl' => url($returnUrl),
                'cancelUrl' => url($cancelUrl),
            ))->setItems(array(
                array('name' => $packageId, 'quantity' => $qty, 'price' => $price)
            ))->send();

            // return response()->json($response->redirect());

            $request->session()->put('packageID', $packageId);
            $request->session()->put('qty', $qty);
            return $response;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function paypalGateway()
    {
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $gateway->setTestMode(true);

        return $gateway;
    }

    public function paypalCheck()
    {

        $gateway = $this->paypalGateway();

        try {
            $response = $gateway->purchase(array(
                'amount' => 30 * 2,
                'currency' => env('PAYMENT_CURRENCY'),
                'returnUrl' => url('paymentsuccess'),
                'cancelUrl' => url('paymenterror'),
            ))->setItems(array(
                array('name' => 'item2', 'quantity' => 1, 'price' => '60.00')
            ))->send();

            // return response()->json($response->redirect());
            // dd($response);
            if ($response->isRedirect()) {
                $response->redirect();
                // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function success(Request $request)
    {
        // dd($request);
        $transaction = $this->paypalGateway()->completePurchase(array(
            'payerId'             => $request->PayerID,
            'transactionReference' => $request->paymentId,
        ));
        $response = $transaction->send();
        // dd($response);
        if (!$response->isSuccessful()) {
            return redirect('/payment/package')->withErrors([
                'cancel' => 'Your Payment was unsuccessfull.'
            ]);
        }

        $item = $response->getData()['transactions'][0]['item_list']['items'][0];
        $packageId = $item['name'];
        $qty = $item['quantity'];

        $package = PaymentPackage::find($packageId);
        $payment = Payment::firstOrCreate([
            'user_id' => Auth::user()->id
        ]);

        $this->packageLog($payment->user_id, $packageId, $qty, $package->price);

        if ($package->is_subscription == 1) {
            $payment->is_subscribed = 1;
            $payment->start_date = $payment->start_date ? $payment->start_date : now();
            $payment->end_date = Carbon::parse($payment->end_date)->addDays($package->subscription_length * 30);

            $payment->save();
        } else {
            $payment->allowed_posts += $package->post_amount * $qty;
            $payment->save();
        }
        return inertia::render('Payment/PaymentSuccess');
    }

    public function cancel()
    {
        return redirect('/payment/package')->withErrors([
            'cancel' => 'Your Payment was unsuccessfull.'
        ]);
    }

    public function packageLog($user_id, $packageId, $amount, $price)
    {
        PackageLog::create([
            'user_id' => $user_id,
            'package_id' => $packageId,
            'amount' => $amount,
            'price' => $price,
        ]);
    }
}
