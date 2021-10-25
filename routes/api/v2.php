<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostAttributeController;
use Illuminate\Http\Request;

// Favorite

Route::middleware('auth:sanctum')->get('/favorites', [App\Http\Controllers\v2\FavoriteController::class, 'list']);
Route::middleware('auth:sanctum')->get('favorite/check/{postID}', [App\Http\Controllers\v2\FavoriteController::class, 'show']);
Route::middleware('auth:sanctum')->post('favorite/toggle', [App\Http\Controllers\v2\FavoriteController::class, 'toggle']);

Route::middleware('auth:sanctum')->post('favorite/filter', [App\Http\Controllers\v2\FavoriteController::class, 'toggleFilter']);
Route::middleware('auth:sanctum')->get('favorite/filter', [App\Http\Controllers\v2\FavoriteController::class, 'myFilters']);
Route::middleware('auth:sanctum')->delete('favorite/filter/{id}', [App\Http\Controllers\v2\FavoriteController::class, 'destroyFilter']);


// User

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('user/{id}', [App\Http\Controllers\v2\ApiController::class, 'user']);
Route::middleware('auth:sanctum')->post('/user/update', [App\Http\Controllers\v2\ApiController::class, 'userUpdate']);
Route::middleware('auth:sanctum')->get('me', function (Request $request) {
    return response()->json([
        'success' => true,
        'user' => Auth::user()
    ]);
});

// Category

Route::get('category', [App\Http\Controllers\v2\ApiController::class, 'categories']);
Route::get('category/{ID}', [App\Http\Controllers\v2\ApiController::class, 'category']);
Route::get('child-categories/{parent_id}', [App\Http\Controllers\v2\ApiController::class, 'childCategory']);

// Category Properties

Route::get('category-properties/{category_id}', [App\Http\Controllers\v2\ApiController::class, 'categoryProperties']);

// Post

Route::get('posts', [App\Http\Controllers\v2\ApiController::class, 'posts']);
Route::get('post/{post}', [App\Http\Controllers\v2\ApiController::class, 'post']);
Route::middleware('auth:sanctum')->put('post/{ID}', [App\Http\Controllers\v2\ApiController::class, 'postUpdate']);
Route::middleware('auth:sanctum')->post('post', [App\Http\Controllers\v2\ApiController::class, 'postCreate']);
Route::middleware('auth:sanctum')->delete('post/{post_id}', [App\Http\Controllers\v2\ApiController::class, 'postDelete']);
Route::middleware('auth:sanctum')->get('/my-posts', [App\Http\Controllers\v2\ApiController::class, 'myPosts']);

Route::get('post-attributes', [PostAttributeController::class, 'index']);

// Post Image

Route::get('post-image/{post_id}', [App\Http\Controllers\v2\ApiController::class, 'postImage']);
Route::middleware('auth:sanctum')->post('post-image', [App\Http\Controllers\v2\ApiController::class, 'postImageCreate']);
Route::middleware('auth:sanctum')->post('post-image/{ID}', [App\Http\Controllers\v2\ApiController::class, 'postImageUpdate']);
Route::middleware('auth:sanctum')->delete('post-image/{ID}', [App\Http\Controllers\v2\ApiController::class, 'postImageDelete']);

// Related Ad

Route::get('/related-ads', [App\Http\Controllers\v2\ApiController::class, 'relatedAds']);

// Article

Route::get('article', [App\Http\Controllers\v2\ApiController::class, 'Articles']);
Route::get('article/{ID}', [App\Http\Controllers\v2\ApiController::class, 'Article']);

// Location

Route::get('city', [App\Http\Controllers\v2\ApiController::class, 'cities']);
Route::get('region', [App\Http\Controllers\v2\ApiController::class, 'regions']);

// Account

Route::post('emailcheck', [UserController::class, 'emailCheck']);
Route::get('emailcheck', [UserController::class, 'emailCheck']);
Route::post('/register', [App\Http\Controllers\v2\ApiController::class, 'register']);
Route::post('/login', [App\Http\Controllers\v2\ApiController::class, 'login']);
Route::middleware('auth:sanctum')->get('/logout', [App\Http\Controllers\v2\ApiController::class, 'logout']);
Route::middleware('auth:sanctum')->put('/reset-password', [App\Http\Controllers\v2\ApiController::class, 'resetPassword']);
Route::middleware('auth:sanctum')->put('/account-setting', [App\Http\Controllers\v2\ApiController::class, 'accountSetting']);
Route::get('csrf-token', function () {
    return [
        "success" => true,
        "csrf_token" => csrf_token()
    ];
});

// Stripe

//Route::middleware('auth:sanctum')->post('/transaction', [PaymentController::class, 'checkout']);
Route::post('/transaction', [PaymentController::class, 'checkoutApp']);
Route::middleware('auth:sanctum')->get('/check', function () {
    return Inertia::render('Check');
});

// Subscription

Route::middleware('auth:sanctum')->get('/my-subscription', [App\Http\Controllers\v2\ApiController::class, 'subscribedTo'])->name('subscribeto');

// Promocode

Route::middleware('auth:sanctum')->post('/use-promo', [App\Http\Controllers\v2\ApiController::class, 'usePromo'])->name('usepromo');

 // transaction
 // Route::get('/packages', [App\Http\Controllers\v2\PaymentController::class, 'packages']);
