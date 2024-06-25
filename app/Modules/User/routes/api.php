<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Http\Controllers')->prefix('api')->middleware('api')->group(function () {

        Route::post('register', 'AuthController@register')->middleware('throttle:6,1');
//        Route::post('resend/code', 'AuthController@resendCode')->middleware('throttle:6,1');
//        Route::post('forgot/password', 'AuthController@forgotPassword')->middleware('throttle:6,1');
        Route::post('login', 'AuthController@login')->middleware('throttle:6,1');
//        Route::post('login/provider', 'AuthController@loginProvider');
//        Route::post('reset/forgot/password', 'AuthController@changeForgotPassword');
//        Route::post('verify/registration/code', 'AuthController@verifyCode');


    Route::middleware(['api', 'Authorized'])->group(function () {
        Route::post('logout', 'AuthController@logout');

        Route::get('posts', 'PostController@index');
        Route::prefix('post')->group(function () {
            Route::post('/store', 'PostController@store');
            Route::post('/update', 'PostController@update');
            Route::post('/delete', 'PostController@destroy');
            Route::post('/send/comment', 'PostController@commentPost');

        });

        Route::get('comments', 'CommenttController@index');
        Route::prefix('comment')->group(function () {
            Route::post('/store', 'CommentController@store');
            Route::post('/update', 'CommentController@store');
            Route::post('/delete', 'CommentController@destroy');
            Route::post('/send/comment', 'CommentController@commentPost');

        });

    });
});
