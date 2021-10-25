<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\fileExists;

class AccountSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Profile/AccountSettings', [
            'myinfo' => Auth::user(),
            'account_setting' => DB::table('account_settings')->where('user_id', Auth::user()->id)
                ->leftJoin('cities', 'cities.id', '=', 'account_settings.city_id')
                ->leftJoin('regions', 'regions.id', '=', 'account_settings.region_id')
                ->select('account_settings.*', 'cities.city_name', 'cities.city_name_ar', 'regions.region_name', 'regions.region_name_ar')
                ->first(),
            'myPackage' => DB::table('payments')->where('user_id', Auth::user()->id)->first()

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
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function show(AccountSetting $accountSetting)
    {
        return Inertia::render('Profile/EditProfile', [
            'user' => Auth::user(),
            'account_settting' => DB::table('account_settings')->where('user_id', Auth::user()->id)
                ->select('shop_banner', 'shop_desc')->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountSetting $accountSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $accountSetting = AccountSetting::where('user_id', Auth::user()->id)->first();
        $accountSetting->city_id = $request->city_id;
        $accountSetting->region_id = $request->region_id;

        $accountSetting->save();

        return Redirect::route('account.index');
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $user->id
        ]);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->is_privacy_enabled = $request->is_privacy_enabled;
        $user->zip = $request->zip;
        $user->mobile = $request->mobile;
        if ($request->file('profile')) {
            $user->profile_photo = (new FileController)->updateFile($request->file('profile'), $user->profile_photo, '/user/');
        }
        $user->save();

        $accountSetting = AccountSetting::where('user_id', Auth::user()->id)->first();
        if ($request->file('shop_banner')) {
            $fileName = (new FileController)->updateFile($request->file('shop_banner'), $accountSetting->shop_banner, '/shop/banner/');
            $accountSetting->shop_banner = $fileName;
        }
        $accountSetting->shop_desc = $request->shop_desc;
        $accountSetting->save();

        return back()->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountSetting  $accountSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountSetting $accountSetting)
    {
        //
    }
}
