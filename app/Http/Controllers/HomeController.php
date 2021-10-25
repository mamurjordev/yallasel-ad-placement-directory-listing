<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function Home()
    {
        return Inertia::render('Home', [
            'regions' => DB::table('regions')->orderBy('region_name')->get(),
            'categories' => DB::table('categories')->orderBy('created_at', 'DESC')->get(),
            // 'latestPosts' => DB::table('posts')->orderByDesc('created_at')->limit(3)->get(),
            'latestPosts' => DB::table('posts')
                ->where('posts.status', 'publish')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->leftJoin('cities', 'cities.id', 'posts.city_id')
                ->leftJoin('post_attributes', 'posts.id', 'post_attributes.post_id')
                ->leftJoin('post_images', function ($query) {
                    $query->on('post_images.post_id', '=', 'posts.id')
                        ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
                })
                ->select('posts.*', 'post_attributes.post_attribute', 'categories.category_name', 'categories.category_name_ar', 'post_images.image', 'cities.city_name', 'cities.city_name_ar')
                ->orderByDesc('posts.created_at')
                ->limit(6)
                ->get(),
            // 'carPosts' => DB::table('posts')->orderByDesc('created_at')->where('category_id', 1)->limit(3)->get()
            'carPosts' => DB::table('posts')
                ->where('posts.status', 'publish')
                ->where('posts.reason', 'for-sale')
                ->where('posts.category_id', 1)
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->leftJoin('cities', 'cities.id', 'posts.city_id')
                ->leftJoin('post_attributes', 'posts.id', 'post_attributes.post_id')
                ->leftJoin('post_images', function ($query) {
                    $query->on('post_images.post_id', '=', 'posts.id')
                        ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
                })
                ->select('posts.*', 'post_attributes.post_attribute', 'categories.category_name', 'categories.category_name_ar', 'post_images.image', 'cities.city_name')
                ->orderByDesc('posts.created_at')
                ->limit(3)
                ->get(),
            'apps' => $this->getApps()
        ]);
    }

    public function getApps()
    {
        $setting = [];
        $datas = DB::table('settings')->whereIn('name', ['android_app', 'ios_app'])->get();
        foreach ($datas as $data) {
            $setting[$data->name] = $data->value;
        }
        return (object)$setting;
    }
}
