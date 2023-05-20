<?php

use Illuminate\Support\Facades\Route;

Route::redirect('home', '/');
Route::get('/', 'HomeController@index')->name('home');
