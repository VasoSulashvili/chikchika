<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TweetController;
use App\Mail\SendFeedCreatedMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Route;
use Profile\Service\Facade\Profile;
use Tweet\Service\Facade\Tweet;
use Carbon\Carbon;
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


Route::get('test' , function(){
    // $details = [
    //     'title' => 'Mail from ItSolutionStuff.com',
    //     'body' => 'This is for testing email using smtp'
    // ];
   
    // Mail::to('v.sulashvili@gmail.com')->send(new SendFeedCreatedMail($details));
   
    // dd("Email is Sent.");
    // $yesterday = Carbon::yesterday();
    // dd($yesterday->addHours(10));
    $followings = Profile::getWhoIFollow(auth()->user()->id)->pluck('followed_user_id')->toArray();
    // dd($followings);
    $tweets = Tweet::emailNotificationTweets(1, 1, 10);
    return view('mails.feed-created')
            ->with('tweets', $tweets);
    
});

/**
 * Home Route
 */
Route::get("/", [HomeController::class, 'index'])->name("home");

/**
 * Profile Routes
 */
Route::get("/{user}", [ProfileController::class, "show"])->name("profile.show");
Route::get("/{user}/edit", [ProfileController::class, "edit"])->name('profile.edit');
Route::put("/{user}/edit", [ProfileController::class, "update"])->name('profile.update');
Route::get('/{user}/tokens/create', [ProfileController::class, 'showToken'])->name('profile.token');
Route::post('/{user}/tokens/create', [ProfileController::class, 'createToken'])->name('profile.token.create');

/**
 * Notification Routes
 */
Route::get("/{user}/notifications", [NotificationController::class, "index"])->name("user.notifications");

/**
 * Tweet Routes
 */
Route::get("/{user}/tweets/{tweet}", [TweetController::class, "show"])->name("tweet.show");
Route::post("/{user}/tweets", [TweetController::class, "store"])->name("tweet.store");
Route::put("/{user}/tweets/{tweet}", [TweetController::class, "update"])->name("tweet.update");
// Route::put("/{user}/tweets/{tweet}", [TweetController::class, "update"])->name("tweet.update");


// Auth Routes
require __DIR__.'/auth.php';
