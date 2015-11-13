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
// Main page
Route::get('/', 'Auth\AuthController@getLogin');


Route::resource('itemTypes', 'ItemTypeController');

Route::get('itemTypes/{id}/delete', [
    'as' => 'itemTypes.delete',
    'uses' => 'ItemTypeController@destroy',
]);
