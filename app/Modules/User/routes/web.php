<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Http\Controllers')->group(function () {
    Route::prefix(config('User.moduleName'))->group(function () {
        require('user.php');
    });
});
