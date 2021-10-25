<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Profile/SavedAds', [
            'ads' => DB::table('favorites')
                ->where('favorites.user_id', Auth::user()->id)
                ->join('posts', 'posts.id', '=', 'favorites.post_id')
                ->join('cities', 'cities.id', '=', 'posts.city_id')
                ->leftJoin('post_images', function ($query) {
                    $query->on('post_images.post_id', '=', 'posts.id')
                        ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
                })
                ->select('favorites.id', 'posts.id as post_id', 'post_images.image', 'posts.title', 'posts.expected_price', 'cities.city_name')
                ->get()
        ]);
    }

    public function list()
    {
        $lists = DB::table('favorites')
            ->where('favorites.user_id', Auth::user()->id)
            ->join('posts', 'posts.id', '=', 'favorites.post_id')
            ->join('cities', 'cities.id', '=', 'posts.city_id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('favorites.id', 'posts.id as post_id', 'post_images.image', 'posts.title', 'posts.expected_price', 'cities.city_name')
            ->get();
        return response()->json($lists);
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
        $check = DB::table('favorites')->where('user_id', $request->user()->id)->where('post_id', $request->post_id)->first();
        if (empty($check)) :
            $favorite = new Favorite();
            $favorite->user_id = $request->user()->id;
            $favorite->post_id = $request->post_id;
            $favorite->save();
            return response()->json(['success' => true]);
        else :
            return response()->json(['success' => false]);
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show($postID)
    {
        $favorite = DB::table('favorites')->where('user_id', Auth::user()->id)->where('post_id', $postID)->first();
        if ($favorite) {
            return response()->json(['favorite' => true]);
        } else {
            return response()->json(['favorite' => false]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy($postID)
    {
        $favorite = Favorite::where('user_id', Auth::user()->id)->where('post_id', $postID);
        if ($favorite) :
            $favorite->delete();
            return response()->json(['success' => true]);
        else :
            return response()->json(['success' => false]);
        endif;
    }
}
