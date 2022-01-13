<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'votes',
    'namespace' => 'Services\Vote\Http\Controllers'
], function () {
    Route::get('index', 'VoteController@indexAction');
    Route::post('create', 'VoteController@createAction');
    Route::post('status', 'VoteController@statusAction');
});
