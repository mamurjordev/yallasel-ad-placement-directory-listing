<?php

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ChatRoomController;
use App\Http\Controllers\FavoriteController;

// Favorite

Route::middleware('auth')->post('/favorites', [FavoriteController::class, 'store']);
Route::middleware('auth')->delete('/favorite/{postID}', [FavoriteController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/favorites', [FavoriteController::class, 'list']);
Route::middleware('auth:sanctum')->post('/favorites/add', [FavoriteController::class, 'store']);

// Route::middleware('auth:sanctum')->delete('/favorite/remove/{postID}', [FavoriteController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('favorite/check/{postID}', [FavoriteController::class, 'show']);

// User

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('user/{id}', [ApiController::class, 'user']);
Route::middleware('auth:sanctum')->put('user/{id}', [ApiController::class, 'userUpdate']);
Route::middleware('auth:sanctum')->get('me', function (Request $request) {
    return $request->user();
});

// Category

Route::get('category', [ApiController::class, 'categories']);
Route::get('category/{ID}', [ApiController::class, 'category']);
Route::get('child-categories/{parent_id}', function ($parent_id) {
    return Category::all()->where('parent_category', $parent_id);
});

// Category Properties

Route::get('category-properties/{category_id}', [ApiController::class, 'categoryProperties']);

// Post

Route::get('posts', [ApiController::class, 'posts']);
Route::get('post/{ID}', [ApiController::class, 'post']);
Route::middleware('auth:sanctum')->put('post/{ID}', [ApiController::class, 'postUpdate']);
Route::middleware('auth:sanctum')->post('post', [ApiController::class, 'postCreate']);
Route::middleware('auth:sanctum')->delete('post/{post}', [ApiController::class, 'postDelete']);

// Post Image

Route::get('post-image/{post_id}', [ApiController::class, 'postImage']);
Route::middleware('auth:sanctum')->post('post-image', [ApiController::class, 'postImageCreate']);
Route::middleware('auth:sanctum')->post('post-image/{ID}', [ApiController::class, 'postImageUpdate']);
Route::middleware('auth:sanctum')->delete('post-image/{ID}', [ApiController::class, 'postImageDelete']);

// Related Ad

Route::get('/related-ads', [ApiController::class, 'relatedAds']);

// Article

Route::get('article', [ApiController::class, 'Articles']);
Route::get('article/{ID}', [ApiController::class, 'Article']);

// Location

Route::get('city', [ApiController::class, 'cities']);
Route::get('region', [ApiController::class, 'regions']);

// Account

// Route::post('emailcheck', [UserController::class, 'emailCheck']);
Route::get('/emailcheck', [UserController::class, 'emailCheck']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::middleware('auth:sanctum')->put('/reset-password', [ApiController::class, 'resetPassword']);
Route::middleware('auth:sanctum')->put('/account-setting', [ApiController::class, 'accountSetting']);
Route::get('csrf-token', function () {
    return csrf_token();
});

// Stripe

//Route::middleware('auth:sanctum')->post('/transaction', [PaymentController::class, 'checkout']);
Route::post('/transaction', [PaymentController::class, 'checkout']);
Route::middleware('auth:sanctum')->get('/check', function () {
    return Inertia::render('Check');
});

// Chat

Route::middleware(['auth'])->group(function () {
    Route::get('my-rooms', [ChatRoomController::class, 'index']);
    Route::get('chat/room/{roomId}', [ChatController::class, 'index']);
    Route::post('chat', [ChatController::class, 'store']);
    Route::post('typing-user/{roomID}', [ChatRoomController::class, 'typing']);
    Route::get('typing-user/{roomID}', [ChatRoomController::class, 'getTyping']);
});
