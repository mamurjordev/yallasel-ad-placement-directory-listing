<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Models\Post;
use Inertia\Inertia;
use App\Models\Payment;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Http\Request;
use App\Models\PostAttribute;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Facade\FlareClient\Stacktrace\File;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;
use function PHPUnit\Framework\fileExists;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified')->only('create');
    }

    public function isFreeAllowed()
    {
        return DB::table('settings')->where('name', 'free_post')->first()->value;
    }

    public function postAllowedCheck()
    {
        $payment = DB::table('payments')->where('user_id', Auth::user()->id)->first();
        if ($payment) {
            if ($payment->end_date > now()) {
                return 'subscribed';
            } elseif ($payment->allowed_posts > 0) {
                return 'allowed_posts';
            } else {
                return false;
            }
        }
    }

    public function allowSellerPage($user_id)
    {
        $payment = DB::table('payments')->where('user_id', $user_id)->first();
        if ($payment) {
            if ($payment->end_date > Carbon::now()) {
                return 'subscribed';
            } else {
                return false;
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Ads', [
            'posts' => DB::table('posts')
                ->orderByDesc('posts.created_at')
                ->join('regions', 'posts.region_id', '=', 'regions.id')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->leftJoin('post_images', function ($query) {
                    $query->on('post_images.post_id', '=', 'posts.id')
                        ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
                })
                ->select('posts.id', 'posts.title', 'posts.created_at', 'posts.expected_price', 'regions.region_name', 'post_images.image')
                ->paginate(10),

            'vipPosts' => DB::table('posts')
                ->where('is_paid', 1)
                ->orderByDesc('posts.created_at')
                ->join('regions', 'posts.region_id', '=', 'regions.id')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->leftJoin('post_images', function ($query) {
                    $query->on('post_images.post_id', '=', 'posts.id')
                        ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
                })
                ->select('posts.id', 'posts.title', 'posts.created_at', 'posts.expected_price', 'regions.region_name', 'post_images.image', 'categories.id as category_id', 'categories.category_name')
                ->limit(5)->get(),

            // 'categories' => DB::table('categories')
            // ->where('id', $id)
            // ->orWhere('parent_category', $id)
            // ->orderBy('id', 'DESC')
            // ->select('id', 'category_name', 'items_count', 'id', 'category_name', 'items_count')
            // ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($this->isFreeAllowed() == 0) {
            if (!$this->postAllowedCheck()) {
                // return redirect('/payment/package');
            }
        }

        return Inertia::render('Profile/PostAd', [
            'categories' => DB::table('categories')->orderBy('category_name')->get(),
            'cities' => DB::table('cities')->orderBy('city_name')->get(['id', 'city_name']),
            'regions' => DB::table('regions')->orderBy('region_name')->get(['id', 'region_name']),
            'category_id' => $request->c ? $request->c : null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        if (!Auth::user()->hasVerifiedEmail()) {
            Auth::user()->sendEmailVerificationNotification();
            return redirect('/email/verify')->with('email', Auth::user()->email);
        }

        // $a = json_encode(json_decode($request->postProperties));

        // dd($a . '<br>' . $request->postProperties);

        $post = new Post();

        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->heading;
        $post->detail = $request->text;

        $post->name = $request->name;
        $post->email = Auth::user()->email;
        $post->phone = $request->phone;
        $post->hidePhoneInAd = $request->hidePhoneInAd == true ? 1 : 0;

        $post->zipcode = $request->zipcode;
        $post->city_id = $request->city_id;
        $post->region_id = $request->region_id;

        $post->payment = '12';

        // $post->is_active = $request->;
        $post->reason = $request->reason;
        $post->is_individual = $request->is_individual;
        // $post->is_paid = $request->;
        $post->expected_price = $request->price;
        // $post->is_price_negotiable = $request->;

        $post->status = 'pending';
        // if ($this->isFreeAllowed() == 0) {
        //     if (!$this->postAllowedCheck()) {
        //         $post->status = 'unpaid';
        //     }
        // }

        if ($this->isFreeAllowed() == 0) {
            if (!$this->postAllowedCheck()) {
                return redirect('/payment/package')->with('redirectdata', $post);
            } else {
                $package = $this->postAllowedCheck();
            }

            if ($package == 'allowed_posts') {
                Payment::where('user_id', Auth::user()->id)->decrement('allowed_posts');
                $post->allow_posts_used = true;
            }
        }

        $post->save();

        $i = 1;
        foreach ($request->files as $image) {

            $postimage = new PostImage();
            $postimage->post_id = $post->id;

            $imageName = time() . $i++ . '.' . $image->getClientOriginalExtension();
            $postimage->image = $imageName;
            $image->move(public_path('media/posts'), $imageName);

            $postimage->save();
        }

        $postAttribute = new PostAttribute();
        $postAttribute->post_id = $post->id;
        $postAttribute->post_attribute = json_encode(json_decode($request->postProperties));
        $postAttribute->save();

        $category = Category::find($request->category_id);
        $category->items_count++;
        $category->save();

        return Redirect::route('myad');
    }

    public function pushNotification($postId)
    {
        $post = DB::table('posts')->where('id', $postId)->select('id', 'user_id', 'title')->first();
        $postImage = DB::table('post_images')->where('post_id', $post->id)->select('image')->first();

        $postID = $post->id;
        $userId = $post->user_id;
        $title = $post->title;
        $image = $postImage ? 'https://yallasell.net/media/posts/' . $postImage->image : null;

        $client = new Client();
        $response = $client->request('post', 'https://fcm.googleapis.com/fcm/send', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'key=AAAAmHPLoOU:APA91bH7yz-5Vp3GgoXwqKCHTu86bEDjUOtRRcAPjYBEua-5tonZTEbTb77DRQ1x9w6-oS690q7PZlnUxjvTL5sJBq7ZD-E5INdFihIGArTtR7YWbhxhkQ950RbXbS0qIoHb58YnWilR'
            ],
            'body' => json_encode([
                "notification" =>
                [
                    "body" => "Click here to read more details",
                    "title" => $title,
                    "image" => $image

                ],
                "priority" => "normal",
                "data" => [
                    "click_action" => "FLUTTER_NOTIFICATION_CLICK",
                    "id" => $postID,
                    "user_id" => $userId,
                    "status" => "done",
                    "body" => "Click here to read more details",
                    "title" => $title,
                    "image" => $image
                ],
                "to" => "/topics/all"
            ])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        $post = DB::table('posts')
            ->where('posts.id', $id)
            ->where('status', 'publish')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('cities', 'posts.city_id', '=', 'cities.id')
            ->leftJoin('regions', 'posts.region_id', '=', 'regions.id')
            ->select('posts.*', 'cities.city_name', 'cities.city_name_ar', 'regions.region_name', 'regions.region_name_ar', 'users.name as seller', 'users.mobile', 'users.email', 'users.username')
            ->first();

        $postAttribute = DB::table('post_attributes')->where('post_id', $id)->first();

        $post_images = DB::table('post_images')->where('post_id', $id)->get();
        if (Auth::user()) :
            $favorite = DB::table('favorites')->where('user_id', Auth::user()->id)->where('post_id', $id)->select('id')->first();
        else :
            $favorite = 0;
        endif;
        if ($post) :
            return Inertia::render('SingleAd', [
                'post' => $post,
                'post_images' => $post_images,
                'favorite_id' => $favorite,
                'category' => DB::table('categories')->where('id', $post->category_id)->select('id', 'category_name', 'category_name_ar')->first(),
                'post_attributes' => $postAttribute,
                'widgets' => DB::table('widgets')->where('place', 'single')->get()
            ]);
        else :
            return Inertia::render('Error/404');
        endif;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Request $request)
    {
        if ($post->user_id == Auth::user()->id) :
            return Inertia::render('Profile/EditAd', [
                'post' => $post,
                'categories' => DB::table('categories')->orderBy('category_name')->get(),
                'cities' => DB::table('cities')->orderBy('city_name')->get(['id', 'city_name']),
                'regions' => DB::table('regions')->orderBy('region_name')->get(['id', 'region_name']),
                'category_id' => $request->c ? $request->c : null,
                'postAttributes' => DB::table('post_attributes')->where('post_id', $post->id)->select('id', 'post_id', 'post_attribute')->first(),
                'postImages' => DB::table('post_images')->where('post_id', $post->id)->select('id', 'image')->get()
            ]);
        else :
            return Inertia::render(route('404'));
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'heading' => 'required',
            'text' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'is_individual' => 'required',
            'price' => 'required',
            'terms' => 'required'
        ]);

        $category = Category::find($post->category_id);
        $category->items_count--;
        $category->save();

        $category = Category::find($request->category_id);
        $category->items_count++;
        $category->save();

        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->heading;
        $post->detail = $request->text;

        $post->name = $request->name;
        $post->email = Auth::user()->email;
        $post->phone = $request->phone;
        $post->hidePhoneInAd = $request->hidePhoneInAd == true ? 1 : 0;

        $post->zipcode = $request->zipcode;
        $post->city_id = $request->city_id;
        $post->region_id = $request->region_id;

        $post->payment = '12';

        // $post->is_active = $request->;
        $post->reason = $request->reason;
        $post->is_individual = $request->is_individual;
        // $post->is_paid = $request->;
        $post->expected_price = $request->price;
        // $post->is_price_negotiable = $request->;

        $post->save();

        // dd(explode(',', $request->images));
        // dd($request->images);


        $a = [];
        foreach (explode(',', $request->images) as $img) {
            if ($img == "[object File]") {
            } elseif ($img == "") {
            } else {
                array_push($a, $img);
            }
        }


        $imgs = DB::table('post_images')->where('post_id', $post->id)->whereNotIn('image', $a)->get();
        foreach ($imgs as $delimg) {
            $image_path = public_path('media/posts/' . $delimg->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            DB::table('post_images')->where('id', $delimg->id)->delete();
        }

        $i = 1;
        foreach ($request->files as $image) {

            $postimage = new PostImage();
            $postimage->post_id = $post->id;

            $imageName = time() . $i++ . '.' . $image->getClientOriginalExtension();
            $postimage->image = $imageName;
            $image->move(public_path('media/posts'), $imageName);

            $postimage->save();
        }

        // foreach(json_decode($request->postProperties) as $postProperty):
        DB::table('post_attributes')->where('post_id', $post->id)->delete();
        $postAttribute = new PostAttribute();
        $postAttribute->post_id = $post->id;
        $postAttribute->post_attribute = $request->postProperties;
        $postAttribute->save();
        // endforeach;


        return redirect()->back()->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        $category = Category::find($post->category_id);
        $category->items_count--;
        $category->save();

        return back();
    }

    public function unpublish(Post $post)
    {
        $post->status = 'unpublish';
        $post->save();
        return back();
    }
    public function publish(Post $post)
    {
        $post->status = 'publish';
        $post->save();
        return back();
    }


    // Panel
    public function postList()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Post/List', [
            'posts' => DB::table('posts')
                ->join('categories', 'categories.id', 'posts.category_id')
                ->select('posts.*', 'categories.category_name')
                ->orderBy('posts.updated_at')->paginate(20),
            'list' => ''
        ]);
    }
    public function pendingPostList()
    {
        Inertia::setRootView('admin');
        return Inertia::render('Post/List', [
            'posts' => DB::table('posts')
                ->where('posts.status', 'pending')
                ->join('categories', 'categories.id', 'posts.category_id')
                ->select('posts.*', 'categories.category_name')
                ->orderBy('posts.updated_at')->paginate(20),
            'list' => 'Pending'
        ]);
    }
    public function postView(Post $post)
    {
        $postAttribute = DB::table('post_attributes')->where('post_id', $post->id)->first();
        $post_images = DB::table('post_images')->where('post_id', $post->id)->select('image')->get();
        Inertia::setRootView('admin');
        return Inertia::render('Post/View', [
            'post' => DB::table('posts')
                ->where('posts.id', $post->id)
                ->join('users', 'users.id', '=', 'posts.user_id')
                ->leftJoin('cities', 'posts.city_id', '=', 'cities.id')
                ->leftJoin('regions', 'posts.region_id', '=', 'regions.id')
                ->select('posts.*', 'cities.city_name', 'regions.region_name', 'users.name as seller', 'users.mobile', 'users.email')
                ->first(),
            'post_images' => $post_images,
            'category' => DB::table('categories')->where('id', $post->category_id)->select('id', 'category_name')->first(),
            'post_attributes' => $postAttribute
        ]);
    }

    public function postApprove(Post $post)
    {
        $post->status = 'publish';
        $post->save();

        $this->pushNotification($post->id);

        return redirect('/panel/post/pending');
    }
    public function postDestroy(Post $post)
    {
        if ($post->allow_posts_used) {
            DB::table('payments')->where('user_id', $post->user_id)->increment('allowed_posts');
        }
        $post->delete();
        return redirect()->route('panel.postlist');
    }

    public function destroyMyAds(Post $post)
    {
        if ($post->user_id == Auth::user()->id) {
            $post->delete();
            return back();
        }
    }

    public function PostByUser($username, Request $request)
    {
        $user = DB::table('users')->where('username', $username)->first();

        if (!$user) {
            return redirect('/');
        }

        if (!$this->allowSellerPage($user->id)) {
            return back();
        }
        $reason = "for-sale";
        $sortBy = 'posts.created_at';
        $sort = 'DESC';

        // $region = isset($request->r) ? $request->r : '';
        // $search = isset($request->q) ? $request->q : '';
        $sorted = isset($request->s) ? $request->s : 'l';

        if (isset($request->s)) :
            if ($request->s == 'o') :
                $sortBy = 'posts.created_at';
                $sort = 'ASC';
            elseif ($request->s == 'c') :
                $sortBy = 'posts.expected_price';
                $sort = 'ASC';
            elseif ($request->s == 'm') :
                $sortBy = 'posts.expected_price';
                $sort = 'DESC';
            endif;
        endif;

        if (isset($request->at)) :
            $reason = $request->at;
        endif;
        $regions = explode(',', $request->r);

        $posts = DB::table('posts')->where('posts.user_id', $user->id);
        $posts = $posts->where('reason', $reason);
        if ($request->q) $posts = $posts->where('title', 'LIKE', "%{$request->q}%");
        if ($request->r) $posts = $posts->whereIn('region_id', $regions);
        if ($request->f) $posts = $posts->where('is_individual',  $request->f == 'b' ? false : true);
        $posts = $posts->orderBy($sortBy, $sort)
            ->join('regions', 'posts.region_id', '=', 'regions.id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('post_attributes', 'post_attributes.id', '=', 'posts.id')
            ->leftJoin('post_images', function ($query) {
                $query->on('post_images.post_id', '=', 'posts.id')
                    ->whereRaw('post_images.id IN (select MIN(a2.id) from post_images as a2 join posts as u2 on u2.id = a2.post_id group by u2.id)');
            })
            ->select('posts.id', 'posts.title', 'posts.created_at', 'posts.expected_price', 'regions.region_name', 'post_images.image', 'categories.category_name', 'post_attributes.post_attribute')
            ->paginate(10);

        return Inertia::render('AdsByUser', [
            'posts' => $posts,
            'reason' => $reason,
            'sorted' => $sorted,
            'isIndividual' =>  $request->f,
            'seller' => $user->name,
            'shop' => DB::table('account_settings')->where('user_id', $user->id)
                ->select('shop_banner', 'shop_desc')
                ->first()
        ]);
    }
}
