<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// AUTH ROUTES
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('password/forget', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ForgotPasswordController@changePassword');

Route::middleware('auth:api')->group(function () {

    /********************************** START AUTH API ROUTES *********************************************/
    Route::get('details', 'Auth\LoginController@authenticatedUserDetails');
    Route::post('refresh_token', 'Auth\LoginController@refresh');
    Route::post('logout', 'Auth\LogoutController@logout');


    Route::resource('users', 'UserController');
});
