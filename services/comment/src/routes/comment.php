<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'comments',
    'namespace' => 'Services\Comment\Http\Controllers'
], function () {
    Route::get('index', 'CommentController@indexAction');
    Route::get('last-comments', 'CommentController@lastCommentsAction');
    Route::post('create', 'CommentController@createAction');
    Route::post('status', 'CommentController@statusAction');
});
