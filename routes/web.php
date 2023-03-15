<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Routes Used In Dashboard
Route::group([], function () {
    Route::get('lockscreen', [App\Http\Controllers\LockScreenController::class, 'lock'])->name('lock');
    Route::post('lockscreen', [App\Http\Controllers\LockScreenController::class, 'unlock'])->name('unlock');

    Route::get('auth/provider/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('auth.provider');
    Route::get('auth/socialite/callback', [SocialLoginController::class, 'providerCallback'])->name('auth.callback');

    Auth::routes(['register' => false]);
});

Route::redirect('/home', '/');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/maintenance', [HomeController::class, 'maintenance'])->name('maintenance');
Messenger\Chat\MessengerRoutes::routes();

