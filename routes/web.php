<?php

use Illuminate\Broadcasting\BroadcastController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Auth::routes();
// Auth::routes(['register' => false]);

Route::redirect('/home', '/dashboard');
Route::redirect('/', '/dashboard');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('lockscreen', [App\Http\Controllers\LockScreenController::class, 'lock'])->name('lock');
Route::post('lockscreen', [App\Http\Controllers\LockScreenController::class, 'unlock'])->name('unlock');

Route::post('/broadcasting/auth', function() {
    return auth()->user();
});
