<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'review-settings',
    'namespace' => 'Services\Review\Http\Controllers'
], function () {
    Route::get('index', 'SettingController@indexAction');
    Route::post('commentable', 'SettingController@commentableAction');
    Route::post('voteable', 'SettingController@voteableAction');
});
