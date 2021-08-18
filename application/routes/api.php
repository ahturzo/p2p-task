<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Api'], function(){
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
    Route::get('allusers', 'AuthController@allusers');
    Route::post('logout', 'AuthController@logout');
});

Route::group([
    'namespace' => 'Api',
    'middleware' => ['jwt.verify']
], function () {
    Route::resource('company', 'CompanyController');
    Route::resource('employee', 'EmployeeController');
});


