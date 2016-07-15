<?php

/*
  |--------------------------------------------------------------------------
  | API routes
  |--------------------------------------------------------------------------
 */

//Route::get('image/{function}/{path}', [
//    //    'middleware' => 'auth',
//    'uses' => 'ImageController@get',
//    'as' => 'image'
//])->where(['function' => '.*', 'path' => '.*']);

//Route::get('image/{path}', [
//    //    'middleware' => 'auth',
//    'uses' => 'ImageController@get',
//    'as' => 'image'
//])->where(['path' => '.*']);

Route::get('image/test', [
    //    'middleware' => 'auth',
    'uses' => 'ImageController@test',
    'as' => 'image.test'
]);

Route::get('users', [
    //    'middleware' => 'auth',
    'uses' => 'UsersController@index',
    'as' => 'users.index'
]);

// =========================================================================
// Authentication routes...

Route::group(['middleware' => ['web']], function () {
    Route::get('auth/login', 'Auth\AuthController@getLogin');
    Route::get('login', 'Auth\AuthController@getLogin'); // An alias
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
});

// =========================================================================
// Registration routes...

Route::group(['middleware' => ['web']], function () {
    Route::get('auth/register', [
        'uses' => 'Auth\AuthController@getRegister'
    ]);
    Route::post('auth/register', [
        'uses' => 'Auth\AuthController@postRegister'
    ]);
});

// =========================================================================
// =========================================================================
// =========================================================================

Route::group(['middleware' => ['web']], function () {
    
    // =========================================================================
    // Home

    Route::get('home', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    // =========================================================================
    // Simulation

    Route::get('simulation', [
        'as' => 'simulation',
        'uses' => 'SimulationController@index',
    ]);

    // =========================================================================
    // Map

    Route::get('map', [
        'middleware' => 'auth',
        'uses' => 'MapController@index',
        'as' => 'map'
    ]);

    Route::get('map/test/animation', [
        'middleware' => 'auth',
        'uses' => 'MapController@animation',
        'as' => 'map.animation'
    ]);

    // =========================================================================
    // User

    Route::get('users', [
        'middleware' => 'auth',
        'uses' => 'UserController@index',
        'as' => 'user.index'
    ]);

    Route::get('user/settings', [
        'middleware' => 'auth',
        'uses' => 'UserController@settings',
        'as' => 'user.settings'
    ]);

    Route::get('user/create', [
        'middleware' => 'auth',
        'uses' => 'UserController@create',
        'as' => 'user.create'
    ]);

    Route::post('user/create', [
        'middleware' => 'auth',
        'uses' => 'UserController@store',
        'as' => 'user.store'
    ]);

    Route::put('user', [
        'uses' => 'UserController@update',
        'as' => 'user'
    ]);

    Route::get('user/first-time/{id}', [
        'uses' => 'UserController@firstTime',
        'as' => 'user.firstTime'
    ]);

    Route::put('user/password', [
        'uses' => 'UserController@changePassword',
        'as' => 'user.password'
    ]);

    Route::get('user/destroy/{id}', [
        'uses' => 'UserController@destroy',
        'as' => 'user.destroy'
    ]);

    Route::get('user/show/{id}/{name}', [
        'middleware' => 'auth',
        'uses' => 'UserController@show',
        'as' => 'user.show'
    ]);

    // =========================================================================
    // HQ (Admin stuff)

    Route::get('hq/logs', [
        'middleware' => 'auth',
        'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
        'as' => 'logs'
    ]);

    Route::get('util/gif/{path}', [
        'middleware' => 'auth',
        'uses' => 'UtilController@gif',
    ])->where(['path' => '.*']);

    // =========================================================================
    // Generator

    Route::get('generator', [
        'middleware' => 'auth', 'uses' => 'GeneratorController@generateWorld'
    ]);

    // =========================================================================
    // Main page

    Route::get('/', 'Auth\AuthController@getLogin');
});
