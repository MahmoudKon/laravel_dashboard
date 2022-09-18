<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Messenger\ConversationController;
use App\Http\Controllers\Messenger\MessageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/maintenance', [HomeController::class, 'maintenance'])->name('maintenance');


Route::get('lockscreen', [App\Http\Controllers\LockScreenController::class, 'lock'])->name('lock');
Route::post('lockscreen', [App\Http\Controllers\LockScreenController::class, 'unlock'])->name('unlock');


Route::middleware('auth')->prefix(LaravelLocalization::setLocale().'/messenger')->group(function() {
    Route::get('/', [ConversationController::class, 'index'])->name('messenger');
    Route::get('users', [ConversationController::class, 'users'])->name('users');

    Route::get('update/last-seen', [ConversationController::class, 'updateLastSeen'])->name('conversations.updateLastSeen');
    Route::get('user/{user}/details', [ConversationController::class, 'userDetails'])->name('user.details');

    Route::get('conversation/{user}/messages', [MessageController::class, 'index'])->name('conversation.user.messages');
    Route::get('conversation/{conversation}/messages/load-more', [MessageController::class, 'getMessages'])->name('conversation.load.messages');
    Route::post('messages', [MessageController::class, 'store'])->name('message.store');
});
