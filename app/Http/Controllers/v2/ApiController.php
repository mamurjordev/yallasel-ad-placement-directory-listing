<?php

namespace App\Http\Controllers\v2;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Article;
use App\Models\Payment;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Models\PostAttribute;
use App\Traits\RegexRange;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    use RegexRange;

    public $baseURL;

    public function __construct()
    {
        $this->baseURL = 'http://yallasell.net';
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                "success" => false,
                'message' => 'Invalid login details'
            ]);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        $user->api_token = $token;
        $user->save();

        return response()->json([
            "success" => true,
            "message" => "Logged in successfully.",
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'user register failed',
                'error' => $validator->errors()
            ]);
        }
        // return response()->json($request->email, 422);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        $user->api_token = $token;
        $user->save();

        $credentials = $request->only('email', 'password');

        Auth::attempt($credentials);

        return response()->json([
            "success" => true,
            'message' => 'registered successfully',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->api_token = null;
        $user->save();
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'logged out successfully'
        ]);
    }

    public function user($user_id)
    {
        $user = User::find($user_id);
        if ($user) :
            return response()->json([
                'success' => true,
                'message' => "Single user list",
                'user' => $user
            ]);
        else :
            return response()->json([
                'success' => false,
                'message' => "User not found",
            ]);
        endif;
    }

    public function userUpdate(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobile' => 'required',
            'zip' => 'required',
            'is_privacy_enabled' => 'required',
        ]);
        if ($validator->fails()) {
            return response([
                'success' => false,
                'message' => 'user register failed',
                'error' => $validator->errors()
            ]);
        }
        if ($user) :
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->zip = $request->zip;
            $user->is_privacy_enabled = $request->is_privacy_enabled;
            $user->updated_at = $request->updated_at;
            if ($request->file('profile_photo')) {
                $user->profile_photo = (new FileController)->updateFile($request->file('profile_photo'), $user->profile_photo, '/user/');
            }
            if ($user->save()) :
                return response()->json([
                    'success' => true,
                    'message' => 'user updated successfully',
                    'user' => $user
                ]);
            else :
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'user update failed',
                    ],
                    400
                );
            endif;
        else :
            return response()->json(
                [
                    'success' => false,
                    'message' => 'user update failed',
                ],
                400
            );
        endif;
    }

    //category
    public function categories()
    {
        $categories = Category::allMainCategoriesWithChildren();
        return [
            'success' => true,
            'message' => 'List of categories',
            'categories' => $categories
        ];
    }

    public function category($id)
    {
        $category = Category::find($id);
        if ($category) {
            return [
                'success' => true,
                'message' => 'Details of ' . $category->category_name . ' category',
                'category' => $category
            ];
        } else {
            return [
                'success' => true,
                'message' => 'No category found',
                'category' => []
            ];
        }
    }

    public function categoryProperties($category_id)
    {
        $category = Category::find($category_id);
        $properties = DB::table('category_properties')
            ->where('category_id', $category_id)
            ->select('id', 'category_id', 'property_icon', 'property_name', 'possible_values', 'property_unit')
            ->get();
        if ($category) {
            return [
                'success' => true,
                'message' => 'Properties of ' . $category->category_name . ' category',
                'properties' => $properties
            ];
        } else {
            return [
                'success' => true,
                'message' => 'No category found',
                'properties' => $properties
            ];
        }
    }

    public function childCategory($parent_id)
    {
        $category = Category::find($parent_id);
        if ($category) {
            return [
                'success' => true,
                'message' => 'List of child category of ' . $category->category_name,
                'childs' => Category::all()->where('parent_category', $parent_id)
            ];
        } else {
            return [
                'success' => true,
                'message' => 'No Category found',
                'childs' => []
            ];
        }
    }

    // POST
    public function posts(Request $request)
    {
        if ($request->sort) {
            $sort = $request->sort;
        } else {
            $sort = 'desc';
        }

        switch ($request->orderby) {
            case 'category_id':
                $orderBy = 'category_id';
                break;
            case 'reason':
                $orderBy = 'reason';
                break;
            case 'city_id':
                $orderBy = 'city_id';
                break;
            case 'region_id':
                $orderBy = 'region_id';
                break;
            case 'is_private':
                $orderBy = 'is_individual';
                break;
            case 'is_paid':
                $orderBy = 'is_paid';
                break;
            default:
                $orderBy = 'id';
        }

        $filters = (object) [
            'min_price' => $request->min_price ?? '',
            'max_price' => $request->max_price ?? '',
            'my_from' => $request->my_from ?? '',
            'my_to' => $request->my_to ?? '',
            'mileage_from' => $request->mileage_from ?? '',
            'mileage_to' => $request->mileage_to ?? '',
            'fuel' => $request->fuel ?? '',
            'gearbox' => $request->gearbox ?? '',
            'hp_from' => $request->hp_from ?? '',
            'brand' => $request->brand ?? '',
            'hp_to' => $request->hp_to ?? '',
            'color' => $request->color ? explode(',', $request->color) : [],
            'car_type' => $request->car_type ? explode(',', $request->car_type) : []
        ];

        $postIds = 'ok';

        if (
            !empty($request->my_from) ||
            !empty($request->my_to) ||
            !empty($request->mileage_from) ||
            !empty($request->mileage_to) ||
            !empty($request->fuel) ||
            !empty($request->gearbox) ||
            !empty($request->hp_from) ||
            !empty($request->hp_to) ||
            !empty($request->color) ||
            !empty($request->car_type)
        ) {

            $postIds = DB::table('post_attributes');
            if ($request->my_from) $postIds = $postIds->where('post_attribute->model year->value', '>=', (int) $request->my_from);
            if ($request->my_to) $postIds = $postIds->where('post_attribute->model year->value', '<=', (int) $request->my_to);

            if ($request->mileage_from) $postIds = $postIds->where('post_attribute->mileage->value', '>=', (int) $request->mileage_from);
            if ($request->mileage_to) $postIds = $postIds->where('post_attribute->mileage->value', '<=', (int) $request->mileage_to);

            if ($request->hp_from) $postIds = $postIds->where('post_attribute->horsepower->value', '>=', (int) $request->hp_from);
            if ($request->hp_to) $postIds = $postIds->where('post_attribute->horsepower->value', '<=', (int) $request->hp_to);

            if ($filters->fuel) $postIds = $postIds->Where('post_attribute->fuel', 'LIKE', '%' . $filters->fuel . '%');
            if ($filters->gearbox) $postIds = $postIds->Where('post_attribute->gearbox', 'LIKE', '%' . $filters->gearbox . '%');
            if ($request->color) $postIds = $postIds->where('post_attribute->color', 'regexp',  implode('|', $filters->color));
            if ($request->car_type) $postIds = $postIds->where('post_attribute->car type', 'regexp', '\\b(' . implode('|', $filters->car_type) . ')\\b');

            $postIds = $postIds->pluck('post_id')->toArray();
        }

        $posts = Post::with('category')->with('city')->with('region')->with('images')->where('status', 'publish');
        if ($postIds != 'ok') $posts = $posts->whereIn('posts.id',  $postIds);
        if ($request->min_price) $posts = $posts->where('expected_price', '>=', (int) $request->min_price);
        if ($request->max_price) $posts = $posts->where('expected_price', '<=', (int) $request->max_price);

        if ($request->category_id) $posts = $posts->where('category_id', $request->category_id);
        if ($request->reason) $posts = $posts->where('reason', $request->reason);
        if ($request->city_id) $posts = $posts->where('city_id', $request->city_id);
        if ($request->region_id) $posts = $posts->where('region_id', $request->region_id);
        if ($request->is_private) $posts = $posts->where('is_individual', $request->is_private == 'true' ? true : false);
        if ($request->is_paid) $posts = $posts->where('is_paid', $request->is_paid == 'true' ? true : false);
        if ($request->keyword) $posts = $posts->where('title', 'Like', '%' . $request->keyword . '%');

        $posts = $posts->orderBy($orderBy, $sort);
        $posts = $posts->paginate($request->show ?? 10);
        return response()->json([
            'success' => true,
            'message' => 'all post lists with pagination',
            'posts' => $posts,
            'image_path' => $this->baseURL . '/media/posts/',
        ]);
    }
    public function myPosts(Request $request)
    {
        $posts = Post::with('category')->with('city')->with('region')->with('images')->where('status', 'publish');
        if ($request->category_id) $posts = $posts->where('category_id', $request->category_id);
        if ($request->reason) $posts = $posts->where('reason', $request->reason);
        if ($request->city_id) $posts = $posts->where('city_id', $request->city_id);
        if ($request->region_id) $posts = $posts->where('region_id', $request->region_id);
        if ($request->is_private) $posts = $posts->where('is_individual', $request->is_private == 'true' ? true : false);
        if ($request->is_paid) $posts = $posts->where('is_paid', $request->is_paid == 'true' ? true : false);
        $posts->where('user_id', Auth::user()->id);
        $posts = $posts->paginate($request->show ?? 10);
        return response()->json([
            'success' => true,
            'message' => 'all post lists with pagination',
            'posts' => $posts,
            'image_path' => $this->baseURL . '/media/posts/',
        ]);
    }
    public function post($id)
    {
        // $post = Post::find($id)->with(['images', 'city', 'region', 'category', 'postAttribute'])->first();
        $post = Post::where('id', $id)->with(['images', 'city', 'region', 'category', 'postAttribute'])->first();
        if ($post) :
            $data = [
                'success' => true,
                'message' => 'single post',
                'post' => $post,
                'image_path' => $this->baseURL . '/media/posts/',
            ];
        else :
            $data = [
                'success' => false,
                'message' => 'post not found',
                'post' => 0
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
            return response([
                'success' => false,
                'message' => 'post update failed',
                'error' => $validator->errors()
            ]);
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
                if ($request->post_attributes) {
                    DB::table('post_attributes')->where('post_id', $post->id)->update([
                        'post_attribute' => $request->post_attributes
                    ]);
                }

                $data = [
                    'success' => true,
                    'message' => 'post updated successfully',
                    'post' => $post,
                    'post_attribute' => PostAttribute::where('post_id', $post->id)->first()
                ];
            else :
                $data = [
                    'success' => false,
                    'message' => 'post update failed',
                ];
            endif;
        else :
            $data = [
                'success' => false,
                'message' => 'post update failed',
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
        ]);

        if ($validator->fails()) :
            return response(
                [
                    'success' => false,
                    'message' => 'post create failed',
                    'error' => $validator->errors()
                ]
            );
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
            $post->status = 'pending';

            if ($post->save()) :
                if ($request->post_attributes) {
                    PostAttribute::create([
                        'post_id' => $post->id,
                        'post_attribute' => $request->post_attributes
                    ]);
                }

                $data = [
                    'success' => true,
                    'message' => 'Post created successfully. Please wait for approval.',
                    'post_id' => $post->id,
                    'post' => $post,
                    'post_attribute' => PostAttribute::where('post_id', $post->id)->first()
                ];
            else :
                $data = [
                    'success' => false,
                    'message' => 'post create failed',
                ];
            endif;
        endif;
        return response()->json($data);
    }

    public function postDelete($post_id)
    {
        if ($post = Post::find($post_id)) {
            $post->delete();
            return response()->json(['success' => true, 'message' => 'post deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'post delete failed']);
        }
    }

    // POST IMAGE
    public function postImage($post_id)
    {
        $images = DB::table('post_images')->where('post_id', $post_id)->get(['id', 'post_id', 'image']);

        if (count($images) > 0) :
            $data = [
                'success' => true,
                'message' => 'images',
                'data' => $images
            ];
        else :
            $data = [
                'success' => false,
                'message' => 'no image found',
                'data' => 0
            ];
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
            // $postimage = new PostImage();
            // $postimage->post_id = $request->post_id;

            // $imageName = time() . random_int(1, 10) . '.' . $request->image->getClientOriginalExtension();
            // $postimage->image = $imageName;
            // $request->image->move(public_path('media/posts'), $imageName);
            $i = 1;
            foreach ($request->file('image') as $image) {
                $postimage = new PostImage();
                $postimage->post_id = $request->post_id;

                $imageName = time() . $i++ . '.' . $image->getClientOriginalExtension();
                $postimage->image = $imageName;
                $image->move(public_path('media/posts'), $imageName);
                $postimage->save();
                $success = true;
            }
            if ($success) :
                $data = [
                    'success' => true,
                    'message' => 'Image uploaded successfully'
                ];
            else :
                $data = [
                    'success' => false,
                    'message' => 'Image upload was unsuccessful'
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
        if ($post) {
            $relatedAds = DB::table('posts')
                ->where('posts.id', '!=', $postID)
                ->where('posts.category_id', $post->category_id)
                ->orderByDesc('posts.created_at')
                ->join('cities', 'cities.id', '=', 'posts.city_id')
                ->leftJoin('post_images', function ($query) {
                    $query->on('post_images.post_id', '=', 'posts.id')
                        ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
                })
                ->select('posts.id', 'posts.title', 'cities.city_name', 'posts.expected_price', 'post_images.image')
                ->limit($limit)->get();

            return [
                'success' => true,
                'message' => 'List of related ads',
                'related_ads' => $relatedAds
            ];
        } else {
            return [
                'success' => true,
                'message' => 'List of related ads',
                'related_ads' => []
            ];
        }
    }

    // ARTICLE
    public function Articles()
    {
        $articles = DB::table('articles')->orderBy('created_at', 'DESC')->where('status', 'publish')->paginate(10);
        return [
            'success' => true,
            'message' => 'List of articles',
            'articles' => $articles
        ];
    }
    public function Article($id)
    {
        $article = Article::find($id);
        return [
            'success' => true,
            'message' => 'Article details',
            'article' => $article
        ];
    }

    // ACCOUNT
    public function resetPassword(Request $request)
    {
        if (!Auth::user()) {
            return 'not';
        }
        $data = $request->all();
        $validator = Validator::make($data, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) :
            return response([
                'success' => false,
                'message' => 'password reset failed',
                'errors' => $validator->errors()
            ]);
        else :
            // $user = User::find($request->user()->id);
            if (Hash::check($request->oldPassword, $request->user()->password) == true) :
                // $user = DB::table('users')->where('id', $request->user()->id)->get();
                $user = $request->user();
                $user->password = Hash::make($request->password);
                $user->save();
                $user = User::find(Auth::user()->id);
                $token = $user->createToken('auth_token')->plainTextToken;
                $user->api_token = $token;
                $user->save();
                $data = [
                    'success' => true,
                    'message' => 'password reset success',
                    'access_token' => $token,
                    'token_type' => 'Bearer',

                ];
                return response()->json($data);
            else :
                $data = [
                    'success' => false,
                    'message' => 'password reset failed',
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

        return response()->json(
            [
                'success' => true,
                'message' => 'account updated succesfully',
                'data' => $request
            ]
        );
    }

    // Location
    public function cities()
    {
        $cities = DB::table('cities')
            ->orderBy('city_name')
            ->select('id', 'city_name', 'city_name_ar')->get();
        return [
            'success' => true,
            'message' => 'List of cities',
            'cities' => $cities
        ];
    }
    public function regions()
    {
        $regions = DB::table('regions')
            ->orderBy('regions.region_name')
            ->join('cities', 'regions.city_id', '=', 'cities.id')
            ->select('regions.id', 'regions.region_name', 'regions.region_name_ar', 'regions.city_id', 'cities.city_name', 'cities.city_name_ar',)->get();
        return [
            'success' => true,
            'message' => 'List of regions',
            'regions' => $regions
        ];
    }

    // subscription
    public function subscribedTo()
    {
        $data = DB::table('payments')->where('user_id', Auth::user()->id)->select('allowed_posts', 'end_date as subscribed_till')->first();
        return  [
            'success' => true,
            'message' => 'your subscriptions',
            'data' => $data
        ];
    }

    // Promo
    public function usePromo(Request $request)
    {
        $payment = Payment::firstOrCreate([
            'user_id' => Auth::user()->id
        ]);

        $gift = $this->matchCode($request->promo_code);
        if ($gift) {
            if ($gift->type == 'posts') {
                Payment::where('user_id', Auth::user()->id)->update([
                    'allowed_posts' => $gift->post_count
                ]);
            } elseif ($gift->type == 'subscription') {
                $payment->is_subscribed = 1;
                $payment->end_date = Carbon::parse($payment->end_date)->addDays($gift->days);
                $payment->save();
            }
            DB::table('user_redeem')->insert([
                'user_id' => Auth::user()->id,
                'code' => $request->promo_code
            ]);
            return [
                'success' => true,
                'message' => 'Promo code redeem was Successfull.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Promo Code is Invalid or Already used!'
            ];
        }
    }

    public function matchCode($code)
    {
        $isUsed = DB::table('user_redeem')->where('user_id', Auth::user()->id)->where('code', $code)->first();
        if (!$isUsed) {
            $match = DB::table('gift_cards')->where('code', $code)->where('status', 'publish')->first();
            return $match ? $match : false;
        }
        return false;
    }
}
