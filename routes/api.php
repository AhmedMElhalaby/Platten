<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'vendors',
], function () {
    Route::post('login','VendorController@login');
    Route::post('register','VendorController@register');
    Route::group([
        'middleware' => 'auth:vendor'
    ], function() {
        Route::post('logout','VendorController@logout');
    });
});
