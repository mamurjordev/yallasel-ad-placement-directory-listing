<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */

    protected $rootView = 'app';

    // Custom rootView
    // public function rootView(Request $request)
    // {
    //     if ($request->route()->getPrefix() == 'panel') {
    //         $this->rootView = 'admin';
    //     }
    // }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $setting = [];
        $datas = DB::table('settings')->whereIn('name', ['site_logo', 'site_mobile_logo'])->get();
        foreach ($datas as $data) {
            $setting[$data->name] = $data->value;
        }
        return array_merge(parent::share($request), [
            'appName' => config('app.name'),

            // Lazily
            'user' => fn () => $request->user()
                ? $request->user()->only('id', 'name', 'username', 'email', 'profile_photo')
                : null,
            'userCount' => fn () => DB::table('users')->count(),
            'postCount' => fn () => DB::table('posts')->count(),
            'articleviews' => fn () => DB::table('articles')->sum('views'),
            'pendingPosts'  => fn () => DB::table('posts')->where('status', 'pending')->count(),
            'language' => session()->has('lang') ? session()->get('lang') : 'ar',
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'redirectdata' => $request->session()->get('redirectdata'),
                ];
            },
            'setting' => fn () => $setting
        ]);
    }
}
