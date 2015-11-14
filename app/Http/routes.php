<?php


/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function ()
{
	Route::group(['prefix' => 'v1'], function ()
	{
        require Config::get('generator.path_api_routes');
	});
});

Route::get('users', [
//    'middleware' => 'auth',
    'uses' => 'UsersController@index',
    'as' => 'users.index'
]);

// =========================================================================
// Authentication routes...

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// =========================================================================
// Registration routes...

Route::get('auth/register', [
    'uses' => 'Auth\AuthController@getRegister'
]);
Route::post('auth/register', [
    'uses' => 'Auth\AuthController@postRegister'
]);

// =========================================================================
// Item types

Route::resource('itemTypes', 'ItemTypeController');

Route::get('itemTypes/{id}/delete', [
    'as' => 'itemTypes.delete',
    'uses' => 'ItemTypeController@destroy',
]);

// =========================================================================
// Wasteland

Route::get('wasteland', [
    'middleware' => 'auth',
    'uses' => 'HomeController@index',
    'as' => 'wasteland'
]);

// =========================================================================
// Village

Route::get('village', [
    'middleware' => 'auth',
    'uses' => 'HomeController@index',
    'as' => 'village'
]);

// =========================================================================
// Home

Route::get('home', [
    'middleware' => 'auth',
    'uses' => 'HomeController@index',
    'as' => 'home'
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
// Main page

Route::get('/', 'Auth\AuthController@getLogin');
