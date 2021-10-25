<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;


use App\Models\User;
use App\Models\Post;
use App\Models\PostImage;
use Symfony\Component\VarDumper\Cloner\Data;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "success" => false,
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "Logged in successfully",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        // return response()->json($request->email, 422);

        $user = User::create([
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "message" => "",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function user($user_id)
    {
        $user = User::find($user_id);
        if ($user) :
            return response()->json([
                $user
            ]);
        else :
            return response()->json(['user' => 0]);
        endif;
    }

    public function userUpdate($user_id, Request $request)
    {
        $user = User::find($user_id);
        if ($user) :

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->role = $request->role;
            $user->zip = $request->zip;
            $user->is_privacy_enabled = $request->is_privacy_enabled;
            $user->updated_at = $request->updated_at;
            $user->profile_photo_path = $request->profile_photo_path;

            if ($user->save()) :
                return response()->json($user);
            else :
                return response()->json('Something went wrong', 400);
            endif;
        else :
            return response()->json('Something went wrong', 400);
        endif;
    }

    public function categories()
    {
        $categories = Category::allMainCategoriesWithChildren();
        // $categories = DB::table('categories')->orderBy('category_name', 'DESC')->get();
        if (count($categories) > 0) :
            return response()->json($categories);
        else :
            $categories = [
                'category' => 0
            ];
            return response()->json($categories);
        endif;
    }

    public function category($id)
    {
        $category = Category::find($id);
        if ($category) :
            return response()->json($category);
        else :
            return response()->json("Category not found");
        endif;
    }

    public function categoryProperties($category_id)
    {
        $data = DB::table('category_properties')
            ->where('category_id', $category_id)
            ->select('id', 'category_id', 'property_icon', 'property_name', 'possible_values', 'property_unit')
            ->get();
        if (count($data) > 0) :
            return response()->json($data);
        else :
            // $data = ['data' => 0];
            return response()->json(0);
        endif;
    }

    // POST
    public function posts()
    {
        $posts = DB::table('posts')->orderBy('created_at', 'DESC')->paginate(10);
        return response()->json($posts);
    }

    public function post($id)
    {
        $post = Post::find($id);
        if ($post) :
            $data = [
                'data' => $post
            ];
        else :
            $data = [
                'data' => 0
            ];
        endif;
        return response()->json($data);
    }

    public function postUpdate($id, Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'detail' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'payment' => 'required',
            'is_active' => 'required',
            'is_individual' => 'required',
            'is_paid' => 'required',
            'reason' => 'required',

            'expected_price' => 'required',
            'is_price_negotiable' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['error' => $validator->errors()]);
        }

        $post = Post::find($id);
        if ($post) :

            $post->category_id = $request->category_id;
            $post->title = $request->title;
            $post->detail = $request->detail;
            $post->name = $request->name;
            $post->phone = $request->phone;
            $post->hidePhoneInAd = $request->hidePhoneInAd;
            $post->zipcode = $request->zipcode;
            $post->city_id = $request->city_id;
            $post->region_id = $request->region_id;
            $post->payment = $request->payment;
            $post->is_active = $request->is_active;
            $post->is_seller = $request->is_seller;
            $post->is_individual = $request->is_individual;
            $post->is_paid = $request->is_paid;
            $post->expected_price = $request->expected_price;
            $post->is_price_negotiable = $request->is_price_negotiable;
            $post->status = $request->status;

            if ($post->save()) :
                $data = [
                    'update' => $post
                ];
            else :
                $data = [
                    'update' => false
                ];
            endif;
        else :
            $data = [
                'update' => false
            ];
        endif;
        return response()->json($data);
    }

    public function postCreate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'detail' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'payment' => 'required',
            'is_active' => 'required',
            'is_individual' => 'required',
            'is_paid' => 'required',
            'reason' => 'required',

            'expected_price' => 'required',
            'is_price_negotiable' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) :
            return response(['error' => $validator->errors()]);
        else :

            $post = new Post();

            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;
            $post->title = $request->title;
            $post->detail = $request->detail;

            $post->name = $request->name;
            $post->email = $request->email;
            $post->phone = $request->phone;
            $post->hidePhoneInAd = $request->hidePhoneInAd;

            $post->zipcode = $request->zipcode;
            $post->city_id = $request->city_id;
            $post->region_id = $request->region_id;
            $post->reason = $request->reason;

            $post->payment = '12';
            $post->is_individual = $request->is_individual;
            $post->expected_price = $request->expected_price;
            $post->is_price_negotiable = $request->is_price_negotiable;
            $post->status = 'publish';

            if ($post->save()) :

                $data = [
                    'create' => true,
                    'post_id' => $post->id,
                    'post' => $post
                ];
            else :
                $data = [
                    'create' => false,
                ];
            endif;
        endif;
        return response()->json($data);
    }

    public function postDelete(Post $post)
    {
        if ($post) {
            $post->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    // POST IMAGE
    public function postImage($post_id)
    {
        $images = DB::table('post_images')->where('post_id', $post_id)->get(['id', 'post_id', 'image']);

        if (count($images) > 0) :
            $data = ['data' => $images];
        else :
            $data = ['data' => 0];
        endif;
        return response()->json($data);
    }

    public function postImageCreate(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'post_id' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) :
            return response(['error' => $validator->errors(), 'Validation Error']);
        else :
            $postimage = new PostImage();
            $postimage->post_id = $request->post_id;

            $imageName = time() . random_int(1, 10) . '.' . $request->image->getClientOriginalExtension();
            $postimage->image = $imageName;
            $request->image->move(public_path('media/posts'), $imageName);

            if ($postimage->save()) :
                $data = [
                    'data' => $postimage
                ];
            else :
                $data = [
                    'data' => 0
                ];
            endif;
            return response()->json($data);
        endif;
    }

    public function postImageUpdate($id, Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'image' => 'required',
        ]);

        if ($validator->fails()) :
            return response(['error' => $validator->errors(), 'Validation Error']);
        else :
            if ($postimage = PostImage::find($id)) :

                $imageName = time() . random_int(1, 10) . '.' . $request->image->getClientOriginalExtension();
                $postimage->image = $imageName;
                $request->image->move(public_path('media/posts'), $imageName);

                if ($postimage->save()) :
                    $data = [
                        'update' => true,
                        'data' => $postimage
                    ];
                else :
                    $data = [
                        'update' => false,
                    ];
                endif;
                return response()->json($data);
            else :
                $data = [
                    'update' => false,
                ];
                return response()->json($data);
            endif;
        endif;
    }

    public function postImageDelete($id)
    {
        if ($postimage = PostImage::find($id)) :
            $postimage->delete();
            $data = [
                'delete' => true,
                'data' => $postimage
            ];
        else :
            $data = [
                'delete' => false
            ];
        endif;
        return response()->json($data);
    }

    public function relatedAds(Request $request)
    {
        $postID = $request->postID;
        $limit = $request->limit;
        $post = Post::find($postID);
        if (!$post) {
            return response()->json(false);
        }
        $relatedAds = DB::table('posts')
            ->where('posts.id', '!=', $postID)
            ->where('posts.category_id', $post->category_id)
            ->orderByDesc('posts.created_at')
            ->join('cities', 'cities.id', '=', 'posts.city_id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('posts.id', 'posts.title', 'cities.city_name', 'cities.city_name_ar', 'posts.expected_price', 'post_images.image')
            ->limit($limit)->get();

        return $relatedAds;
    }

    // ARTICLE
    public function Articles()
    {
        $articles = DB::table('articles')->orderBy('created_at', 'DESC')->paginate(10);
        if (count($articles) > 0) :
            $articles = [
                'articles' => $articles,
                'image_path' => '/media/articles/'
            ];
            return response()->json($articles);
        else :
            $articles = [
                'articles' => 0
            ];
            return response()->json($articles);
        endif;
    }
    public function Article($id)
    {
        $article = Article::find($id);
        if ($article) :
            $article = [
                'article' => $article,
                'image_path' => '/media/articles/'
            ];
            return response()->json($article);
        else :
            $article = [
                'article' => 0
            ];
            return response()->json($article);
        endif;
    }

    // ACCOUNT
    public function resetPassword(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) :
            return response(['error' => $validator->errors(), 'Validation Error']);
        else :
            // $user = User::find($request->user()->id);
            if (Hash::check($request->oldPassword, $request->user()->password) == true) :
                // $user = DB::table('users')->where('id', $request->user()->id)->get();
                $user = $request->user();

                $user->password = Hash::make($request->password);

                $user->save();

                $data = [
                    'password_reset' => true
                ];
                return response()->json($data);
            else :
                $data = [
                    'password_reset' => false
                ];
                return response()->json($data);
            endif;
        endif;
    }
    public function accountSetting(Request $request)
    {
        DB::table('account_settings')
            ->where('user_id', $request->user()->id)
            ->update(request()->all());

        return response()->json($request);
    }

    // Location
    public function cities()
    {
        $cities = DB::table('cities')
            ->orderBy('city_name')
            ->select('id', 'city_name', 'city_name_ar')->get();
        return response()->json($cities);
    }
    public function regions()
    {
        $regions = DB::table('regions')
            ->orderBy('regions.region_name')
            ->join('cities', 'regions.city_id', '=', 'cities.id')
            ->select('regions.id', 'regions.region_name', 'regions.region_name_ar', 'regions.city_id', 'cities.city_name', 'cities.city_name_ar',)->get();
        return response()->json($regions);
    }

    // check
    public function check(Request $request)
    {
        dd($request->all());
    }
}
