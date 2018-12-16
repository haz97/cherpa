<?php

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::get('/course/{courseId}/class/{classId}','HomeController@view');

});

Route::get('/login', 'HomeController@login')->name('auth.login');