<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web', 'as' => 'users.'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('home', 'HomeController@index')->name('home');
});

