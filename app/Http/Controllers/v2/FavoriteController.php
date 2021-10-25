<?php

namespace App\Http\Controllers\v2;

use Inertia\Inertia;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FavoriteFilter;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

use function Symfony\Component\VarDumper\Dumper\esc;

class FavoriteController extends Controller
{
    use ApiResponser;
    public function toggleFilter(Request $request)
    {
        $data = json_decode(file_get_contents($request->filter_url));
        FavoriteFilter::create([
            'user_id' => Auth::user()->id,
            'ads' => json_encode($data->posts->data)
        ]);
        return $this->success($data->posts->data, 'Filter was added to favorite');
    }

    public function myFilters()
    {
        $filters = FavoriteFilter::where('user_id', Auth::user()->id)->select('id as filter_id', 'ads')->get();
        return $this->success($filters, 'My favorite filters');
    }

    public function destroyFilter($id)
    {
        $data = FavoriteFilter::where('id', (int) $id)->where('user_id', Auth::user()->id)->delete();
        return $this->success('Filter deleted successfully');
    }

    public function toggle(Request $request)
    {
        $store = $this->store($request);
        if ($store) {
            return $store;
        } else {
            return $this->destroy($request);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            ->select('favorites.id as favorite_id', 'posts.*', 'post_images.image', 'cities.city_name')
            ->orderBy('favorites.id', 'desc')
            ->get();
        return [
            'success' => true,
            'message' => 'List of your favorites',
            'favorites' => $lists,
            'image_path' => '/media/posts/'
        ];
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
            return response()->json(['success' => true, 'message' => 'Favorite added successfully', 'is_favorite' => true]);
        else :
            return false;
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
            return response()->json(['success' => true, 'is_favorite' => true]);
        } else {
            return response()->json(['success' => true, 'is_favorite' => false]);
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
    public function destroy(Request $request)
    {
        $favorite = Favorite::where('user_id', Auth::user()->id)->where('post_id', $request->post_id);
        if ($favorite) :
            $favorite->delete();
            return response()->json(['success' => true, 'message' => 'Favorite removed successfully', 'is_favorite' => false]);
        else :
            return response()->json(['success' => false]);
        endif;
    }
}
