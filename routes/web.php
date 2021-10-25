<?php

use App\Http\Controllers\AccountSettingController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ExportController;
use App\Http\Controllers\admin\StatisticsController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\GiftCardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentPackageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WidgetController;
use App\Models\Post;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\StripeController;
use App\Models\AccountSetting;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\VipPostController;
use App\Http\Controllers\WebViewController;
use App\Models\Favorite;
use App\Models\GiftCard;
use App\Models\PostImage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'Home']);
Route::get('/home', [HomeController::class, 'Home'])->name('home');
// Route::get('/{username}', function ($username) {
//     return redirect('/seller/' . $username);
// });

// language
Route::get('/language/{lang}', function ($lang, Request $request) {
    $request->session()->put('lang', $lang);
    return back();
});

// post
Route::resource('/post', PostController::class);
Route::put('/unpublish-post/{post}', [PostController::class, 'unpublish'])->middleware('verified');
Route::put('/publish-post/{post}', [PostController::class, 'publish'])->middleware('verified');

// Authenticate
Route::post('user/login', [UserController::class, 'Login']);
Route::post('user/register', [UserController::class, 'Register']);
Route::get('user/varifyemail', function () {
    return Inertia::render('Auth/VarifyEmail');
});
Route::get('/reregister', [UserController::class, 'reRegister']);
Route::get('/emailcheck', [UserController::class, 'emailCheck']);


Route::get('/user/logout', function (Request $request) {
    $lang = session()->has('lang') ? session()->get('lang') : 'ar';
    Auth::logout();
    $request->session()->put('lang', $lang);
    return redirect('/');
});

// Category
Route::get('/category', [CategoryController::class, 'show']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category/{id}', [CategoryController::class, 'show']);
Route::get('/categories', function () {
    return Inertia::render('Categories', [
        'categories' => DB::table('categories')
            ->where('parent_category')
            ->get()
    ]);
});
Route::get('/seller/{username}', [PostController::class, 'PostByUser']); //posts by seller

Route::resource('ads', PostController::class);
Route::get('filter', [FilterController::class, 'index']);

// Shop
Route::prefix('shop')->group(function () {
    Route::get('open-shop', [ShopController::class, 'openShop']);
});

// Favorite
Route::middleware('auth', 'verified')->get('/saved-ads', [FavoriteController::class, 'index']);
Route::middleware('auth:sanctum')->delete('/favorite/remove/{postID}', [FavoriteController::class, 'destroy']);

Route::middleware('auth')->get('/account/location', function () {
    return Inertia::render('Profile/ChooseLocationCity', [
        'cities' => DB::table('cities')->orderBy('city_name')
            ->select('id', 'city_name', 'city_name_ar')->get()
    ]);
});

Route::middleware('auth')->get('/account/location/region/{id}', function ($id) {
    return Inertia::render('Profile/ChooseLocationRegion', [
        'city' => DB::table('cities')->where('id', $id)
            ->select('id', 'city_name', 'city_name_ar')->first(),
        'regions' => DB::table('regions')->where('city_id', $id)->orderBy('region_name')
            ->select('id', 'region_name', 'region_name_ar')->get(),
        'accountSetting' => DB::table('account_settings')->where('user_id', Auth::user()->id)->select('id')->first()
    ]);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index']);
    Route::get('/check/chat', function () {
        return Inertia::render('Chat/Check');
    });
});
Route::middleware('auth', 'verified')->get('/account/setting', [AccountSettingController::class, 'show']);
Route::middleware('auth', 'verified')->post('/account/setting', [AccountSettingController::class, 'updateProfile']);
Route::middleware('auth', 'verified')->resource('account', AccountSettingController::class);
Route::middleware('auth', 'verified')->get('/my-ads', [ProfileController::class, 'myAds'])->name('myad');

Route::get('/post-ad', [PostController::class, 'create'])->middleware('auth', 'verified');
Route::get('/edit-ad/{post}', [PostController::class, 'edit'])->middleware('auth', 'verified');
// Route::get('/post-ad-car', [PostController::class, 'createCar'])->middleware('auth');
Route::get('/my-ads/place-ad', function () {
    return Inertia::render('Profile/PlaceAdOption');
});
Route::delete('/post/{post}', [PostController::class, 'destroyMyAds'])->middleware('auth');

// Article
Route::get('/article/{article}', [ArticleController::class, 'show']);
Route::get('/articles', function () {
    return Inertia::render('Articles', [
        'articles' => DB::table('articles')->orderByDesc('updated_at')->get()
    ]);
});

// Check
Route::get('/car-number', function () {
    return Inertia::render('Check/Car');
});
Route::get('/add-a-car-ad', function () {
    return Inertia::render('Check/AddaCarAd');
});

// Others
Route::get('/cookies', function () {
    return Inertia::render(('Cookies'));
});
Route::get('/terms-of-use', function () {
    return Inertia::render('TermsofUse', [
        'page' => DB::table('pages')->where('slug', 'terms-of-use')->first()
    ]);
});

// FAQ
Route::get('/faq', function () {
    return Inertia::render('FAQ');
});
Route::get('/faq/{faq}', [FaqController::class, 'show']);
Route::get('/faq/search/{search}', [FaqController::class, 'search']);
Route::get('/contact', function () {
    return Inertia::render('FAQ');
});


Route::get('/profile/listings', function () {
    return Inertia::render('Profile/Listings');
});

Route::get('faqs/{params}', function ($params) {
    return Inertia::render('FAQs', [
        'faqs' => DB::table('faqs as a')
            ->where('a.params', $params)
            ->orderBy('a.sub_category')
            ->join('faqs as b', 'b.sub_category', '=', 'a.sub_category')
            ->select('a.sub_category', 'b.id', 'b.title')
            ->distinct()
            ->get(),
        'pageTitle' => $params
    ]);
});

Route::get('/posts/user/{user}', [UserController::class, 'userPosts']);


// Panel

Route::prefix('panel')->name('panel.')->middleware('auth.admin')->group(function () {
    Route::get('/', [DashboardController::class, 'show']);
    Route::resource('category', CategoryController::class);
    Route::resource('article', ArticleController::class);
    Route::resource('city', CityController::class);
    Route::resource('region', RegionController::class);
    Route::resource('faq', FaqController::class);

    // Post
    Route::get('/post', [PostController::class, 'postList'])->name('postlist');
    Route::get('/post/pending', [PostController::class, 'pendingPostList'])->name('pending.post.list');
    Route::get('/post/view/{post}', [PostController::class, 'postView'])->name('postview');
    Route::get('/post-approve/{post}', [PostController::class, 'postApprove'])->name('postapprove');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('postdestroy');
    Route::get('/post-delete/{post}', [PostController::class, 'postDestroy'])->name('post-destroy');

    // user
    Route::resource('user', UserController::class);
    Route::get('/user/changerole/{user}', [UserController::class, 'role'])->name('changerole');

    // widgets
    Route::get('/widgets/category-page', function () {
        Inertia::setRootView('admin');
        return Inertia::render('Widgets/CategoryPage', [
            'widgets' => DB::table('widgets')->where('place', 'category')->get()
        ]);
    });

    // pages
    Route::prefix('page')->group(function () {
        Route::get('/terms-of-use', [PageController::class, 'editTerms']);
        Route::post('/terms-of-use', [PageController::class, 'updateTerms']);
    });

    Route::get('/widgets/single-page', function () {
        Inertia::setRootView('admin');
        return Inertia::render('Widgets/SinglePage', [
            'widgets' => DB::table('widgets')->where('place', 'single')->get()
        ]);
    })->name('singlePage');

    Route::resource('widgets', WidgetController::class);
    Route::resource('/payment_package', PaymentPackageController::class);
    Route::resource('/giftcard', GiftCardController::class);
    Route::get('/setting/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting/update', [SettingController::class, 'update'])->name('setting.update');
    Route::post('/setting/update/env', [SettingController::class, 'updateEnv'])->name('setting.update.env');

    Route::get('/logout', [UserController::class, 'logoutAdmin'])->name('logout');

    Route::prefix('statistics')->name('statistics')->group(function () {
        Route::get('giftcard', [GiftCardController::class, 'statistics']);
        Route::get('ads', [StatisticsController::class, 'ads']);
        Route::get('users', [StatisticsController::class, 'users']);
        Route::get('package', [StatisticsController::class, 'package']);
    });
    Route::get('setting/apps', [SettingController::class, 'appEdit'])->name('apps.edit');
    Route::put('setting/apps', [SettingController::class, 'appUpdate'])->name('apps.update');
});

Route::get('/panel/login', function () {
    Inertia::setRootView('admin');
    return Inertia::render('Login');
});

Route::post('/panel/login', [UserController::class, 'adminLogin']);

// Errors
Route::get('/404', function () {
    return Inertia::render('Error/404');
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Home');
})->name('dashboard');



// Email Varification
Route::get('/email/verify', function () {
    if (!Auth::user()) {
        return redirect('/login');
    }
    return Inertia::render('Auth/VerifyEmail');
})->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    if (!Auth::user()) {
        return redirect('/login');
    }
    $request->user()->sendEmailVerificationNotification();

    return redirect('/email/verify')->with('message', 'Verification link sent!');
})->middleware(['throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


// Payment
Route::get('/payment/package', [PaymentController::class, 'show']);
Route::get('/payment/success', [PaymentController::class, 'success']);
Route::get('/payment/cancel', [PaymentController::class, 'cancel']);

Route::post('/transaction', [PaymentController::class, 'checkout']);
Route::get('/paymentsuccess', [PaymentController::class, 'success']);
Route::get('/paymenterror', [PaymentController::class, 'cancel']);

// Redeem code
Route::get('/redeem_code', [GiftCardController::class, 'redeem'])->middleware('auth');
Route::post('/redeem_code/submit', [GiftCardController::class, 'redeemSuccess'])->middleware('auth');

// Stripe
// Route::get('/stripe-payment', [StripeController::class, 'handleGet']);
// Route::post('/stripe-payment', [StripeController::class, 'handlePost'])->name('stripe.payment');

Route::get('/forgot-password', function () {
    return Inertia::render('Auth/ForgotPassword');
})->middleware('guest')->name('password.request');

Route::get('/opimize', function () {
    Artisan::call('optimize:clear');
    dd('optimized');
});

// Webview
Route::get('/webview/package', [WebViewController::class, 'package']);
Route::get('/app-payment-success', [PaymentController::class, 'appSuccess']);
Route::get('/app-payment-error', [PaymentController::class, 'appCancel']);
Route::get('/webview/chat', [WebViewController::class, 'chat']);


// Boost Post
Route::middleware('auth')->get('/boosted-post', [VipPostController::class, 'index']);
Route::middleware('auth')->post('/boost-post', [PaymentController::class, 'boostAd']);
Route::middleware('auth')->get('/boost-success', [PaymentController::class, 'boostSuccess']);
Route::middleware('auth')->get('/boost-cancel', [PaymentController::class, 'boostCancel']);


// TMP can delete
Route::get('check', [CheckController::class, 'index']);
