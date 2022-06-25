<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verification', function(){
    return view('auth.resend-email-verification');
})->name('verification.resend');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




Route::group(['middleware' => ['auth']], function(){
    Route::post('logout' , [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['guest']], function(){
    Route::post('login' , [AuthController::class, 'login'])->name('login');
    Route::post('register' , [AuthController::class, 'register'])->name('register');
});
