<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/events',[EventController::class, 'index']);
Route::get('/events/{eventId}',[EventController::class, 'getEventById']);
Route::get('/events/category/{category_id}',[EventController::class, 'eventsByCategory']);
Route::get('/posts',[PostController::class, 'index']);
Route::post('/post/like/{postId}', [\App\Http\Controllers\PostController::class, 'likePost'])
    ->middleware('auth:sanctum');
Route::delete('/post/unlike/{postId}', [\App\Http\Controllers\PostController::class, 'unlikePost'])
    ->middleware('auth:sanctum');
Route::get('/likedPosts', [UserController::class, 'getLikedPosts'])
    ->middleware('auth:sanctum');
Route::put('/profile/edit', [UserController::class, 'updateProfile'])
                ->middleware('auth:sanctum');

require __DIR__.'/auth.php';
