<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function myAds()
    {

        return Inertia::render('Profile/MyAds', [
            'pendingPosts' => $this->getAds('pending'),
            'unPublishedPosts' => $this->getAds('unpublish'),
            'publishedPosts' => $this->getAds('publish'),
            'faqs' => DB::table('faqs')->where('params', 'manage-ad')->where('status', 'publish')->orderBy('updated_at', 'DESC')->limit(20)->get(),
            'boostedAds' => DB::table('posts')->where('user_id', Auth::user()->id)->whereNotNull('boost_until')->where('boost_until', '>=', Carbon::now())->count()
        ]);
    }

    public function getAds(string $status)
    {
        return DB::table('posts')
            ->where('posts.status', $status)
            ->where('posts.user_id', '=', Auth::user()->id)
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('post_attributes', 'posts.id', 'post_attributes.post_id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('posts.*', 'post_attributes.post_attribute', 'categories.category_name', 'post_images.image')
            ->orderByDesc('posts.id')
            ->get();
    }
}
