<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Routes Used In Dashboard
Route::group([], function () {
    Route::get('lockscreen', [App\Http\Controllers\LockScreenController::class, 'lock'])->name('lock');
    Route::post('lockscreen', [App\Http\Controllers\LockScreenController::class, 'unlock'])->name('unlock');

    Route::get('auth/provider/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('auth.provider');
    Route::get('auth/socialite/callback', [SocialLoginController::class, 'providerCallback'])->name('auth.callback');

    Auth::routes(['register' => false]);
});

Route::get('soon', [HomeController::class, 'soon'])->name('soon');
Route::get('maintenance', [HomeController::class, 'maintenance'])->name('maintenance');

Messenger\Chat\MessengerRoutes::routes();
