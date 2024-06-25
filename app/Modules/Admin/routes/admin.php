<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web', 'as' => 'admins.'], function () {
    Route::get('login', 'AuthController@checkLogin')->name('login');
    Route::post('login', 'AuthController@login')->middleware('throttle:6,1');

    Route::middleware('privilege:super')->group(function () {
        Route::get('/', 'DashboardController')->name('home');
        /**
         * Admin Module Routes
         */
        Route::resource('admin', 'AdminController');
        Route::prefix('admins')->group(function () {
            Route::as('admin.')->group(function () {
                Route::get('data', 'AdminController@data')->name('data');
                Route::post('reset/password', 'AdminController@resetPassword')->name('reset.password');
                Route::post('trash', 'AdminController@trash')->name('trash');
                Route::post('restore', 'AdminController@restore')->name('restore');
                Route::get('export', 'AdminController@export')->name('export');
            });
        });

        Route::resource('task', 'TaskController');
        Route::prefix('tasks')->group(function () {
            Route::as('task.')->group(function () {
                Route::post('file/decrypt/{id}', 'TaskController@decrypt')->name('decrypt');
                Route::get('file/download/{id}', 'TaskController@download')->name('download');
                Route::get('data', 'TaskController@data')->name('data');
                Route::post('trash', 'TaskController@trash')->name('trash');
                Route::post('restore', 'TaskController@restore')->name('restore');
                Route::get('export', 'TaskController@export')->name('export');
            });
        });
        /**
         * Logout..
         */
        Route::get('logout', 'AuthController@logout')->name('logout');
    });
});

