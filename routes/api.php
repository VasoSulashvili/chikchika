<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TweetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function()
{
    Route::get('v1/me', [UserController::class, 'show']);
    Route::get('v1/me/following', [UserController::class, 'following']);
    Route::get('v1/me/follows', [UserController::class, 'follows']);
    Route::get('v1/tweets', [TweetController::class, 'tweets']);
    Route::post('v1/tweets', [TweetController::class, 'createTweet']);
    Route::get('v1/tweets/{tweet_id}', [TweetController::class, 'tweet']);
    Route::get('v1/tweets/{tweet_id}/replies', [TweetController::class, 'replies']);
    Route::post('v1/tweets/{tweet_id}/like', [TweetController::class, 'like']);
    Route::delete('v1/tweets/{tweet_id}/unlike', [TweetController::class, 'unlike']);
    Route::post('v1/tweets/{tweet_id}/reply', [TweetController::class, 'createReply']);

    
    Route::post('test/test/test', function()
    {
        return response()->json(['dddddd' => auth()->user()->id]);
    });
});
