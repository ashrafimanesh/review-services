<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'products',
    'namespace' => 'Services\Product\Http\Controllers'
], function () {
    Route::get('index', 'ProductController@indexAction');
    Route::post('visibility', 'ProductController@visibilityAction');
});
