<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Admin\Http\Controllers')->group(function () {
    Route::prefix(config('Admin.moduleName'))->group(function () {
        require('admin.php');
    });
});
