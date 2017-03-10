<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('image/{path}', [
//    'middleware' => 'auth',
    'uses' => 'ImageController@get',
    'as' => 'image'
])->where(['path' => '.*']);

Route::get('users', [
//    'middleware' => 'auth',
    'uses' => 'UsersController@index',
    'as' => 'users.index'
]);

// =========================================================================
// Authentication routes...

Route::get('/', 'Auth\LoginController@login')->name('mainpage');

//Route::get('login', 'Auth\AuthController@getLogin');
//Route::get('logout', 'Auth\AuthController@getLogout');
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
$this->get('login/{auto?}', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('login.post');
$this->get('logout', 'Auth\LoginController@logout')->name('logout');
$this->get('auth/login/{auto?}', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('auth/login', 'Auth\LoginController@login')->name('login.post');
$this->get('auth/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

// =========================================================================
// Item types

Route::resource('itemTypes', 'ItemTypeController');

Route::get('itemTypes/{id}/delete', [
    'as' => 'itemTypes.delete',
    'uses' => 'ItemTypeController@destroy',
]);

// =========================================================================
// Simulation

Route::get('simulation', [
    'as' => 'simulation',
    'uses' => 'SimulationController@index',
]);

// =========================================================================
// Worldmap

Route::get('worldmap', [
    'middleware' => 'auth',
    'uses' => 'WorldmapController@index',
    'as' => 'worldmap'
]);

// =========================================================================
// Location

Route::get('location', [
    'middleware' => 'auth',
    'uses' => 'LocationController@index',
    'as' => 'Location'
]);

// =========================================================================
// Home

Route::get('home', 'VillageController@index')->name('home');
Route::get('village', 'VillageController@index')->name('village');

// =========================================================================
// Person

Route::get('band', [
    'middleware' => 'auth',
    'uses' => 'BandController@index',
    'as' => 'band'
]);

Route::get('person/show/{id}', [
    'middleware' => 'auth',
    'uses' => 'PersonController@show',
    'as' => 'person.show'
]);

Route::get('person/destroy/{id}', [
    'middleware' => 'auth',
    'uses' => 'PersonController@destroy',
    'as' => 'person.destroy'
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
    'as' => 'logs'
])->where(['path' => '.*']);

// =========================================================================
// Generator

Route::get('generator', [
    'middleware' => 'auth', 'uses' => 'GeneratorController@generateWorld'
]);

// === HQ ==================================================================

Route::get('hq/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
