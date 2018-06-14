<?php

Route::post('register', 'API\AuthController@register');
Route::post('login', 'API\AuthController@login');
Route::post('recover', 'API\AuthController@recover');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'API\AuthController@logout');

    Route::get('dashboard', 'API\DashboardController@index');
});
