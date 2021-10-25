<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        $payment = [
            'paypal_client_id' => env('PAYPAL_CLIENT_ID'),
            'paypal_client_secret' => env('PAYPAL_CLIENT_SECRET'),
            'payment_currency' => env('PAYMENT_CURRENCY')
        ];
        $mail = [
            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
        ];
        Inertia::setRootView('admin');

        $setting = [];
        $datas = DB::table('settings')->whereIn('name', ['site_title', 'site_logo', 'site_mobile_logo', 'free_post', 'ad_boost_price'])->get();
        foreach ($datas as $data) {
            $setting[$data->name] = $data->value;
        }

        return Inertia::render('Settings/Setting', [
            // 'free_post' => $free_post
            'setting' => (object)$setting,
            'payment' => $payment,
            'mail' => $mail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $files = ['site_logo' => null, 'site_mobile_logo' => null];
        $data = $request->all();
        array_shift($data);
        $datas = array_diff_key($data, $files);
        foreach ($datas as $key => $value) {
            Setting::where('name', $key)->update(['value' => $value]);
        }
        foreach ($request->files as $key => $file) {
            $setting = Setting::where('name', $key)->first();
            $upload = (new FileController)->updateFile($file, $setting->value, '/site/');
            $setting->update(['value' => $upload]);
        }

        return back()->with('success', 'Setting changed successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function appEdit()
    {
        $setting = [];
        $datas = DB::table('settings')->whereIn('name', ['android_app', 'ios_app'])->get();
        foreach ($datas as $data) {
            $setting[$data->name] = $data->value;
        }
        Inertia::setRootView('admin');
        return Inertia::render('Settings/Apps', [
            'setting' => (object)$setting
        ]);
    }
    public function appUpdate(Request $request)
    {
        $request->android_app ? Setting::where('name', 'android_app')->update(['value' => $request->android_app]) : '';
        $request->ios_app ? Setting::where('name', 'ios_app')->update(['value' => $request->ios_app]) : '';
        return back()->with('success', 'Apps Information updated successfully');
    }

    public function updateEnv(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            Artisan::call('env:set ' . $key . '=' . str_replace(' ', '', $value));
        }
        return back()->with('success', 'Payment Information updated successfully');
    }
}
