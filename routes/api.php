<?php

Route::post('login', 'API\AuthController@login');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'API\AuthController@logout');

    Route::get('dashboard', 'API\DashboardController@index');
});
