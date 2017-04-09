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
    //    
    'uses' => 'ImageController@get',
    'as' => 'image'
])->where(['path' => '.*']);

Route::get('users', [
    //    
    'uses' => 'UsersController@index',
    'as' => 'users.index'
]);

// =========================================================================
// Authentication routes...

Route::get('/', 'Auth\LoginController@showLoginForm')->name('mainpage');

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

Route::group(['middleware' => ['auth']], function() {

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

    Route::get('worldmap', 'WorldmapController@show')->name('worldmap');

    // =========================================================================
    // Location

    Route::get('location', 'EngineController@engine')->name('engine');

    // =========================================================================
    // Home

    Route::get('home', 'VillageController@index')->name('home');
    Route::get('village', 'VillageController@index')->name('village');

    // =========================================================================
    // Person

    Route::get('band', [
        'uses' => 'BandController@index',
        'as' => 'band'
    ]);

    Route::get('person/show/{id}', [
        'uses' => 'PersonController@show',
        'as' => 'person.show'
    ]);

    Route::get('person/destroy/{id}', [
        'uses' => 'PersonController@destroy',
        'as' => 'person.destroy'
    ]);

    // =========================================================================
    // User

    Route::get('users', [
        'uses' => 'UserController@index',
        'as' => 'user.index'
    ]);

    Route::get('user/settings', [
        'uses' => 'UserController@settings',
        'as' => 'user.settings'
    ]);

    Route::get('user/create', [
        'uses' => 'UserController@create',
        'as' => 'user.create'
    ]);

    Route::post('user/create', [
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
        'uses' => 'UserController@show',
        'as' => 'user.show'
    ]);

    // =========================================================================
    // HQ (Admin stuff)

    Route::get('hq/logs', [
        'uses' => '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index',
        'as' => 'logs'
    ]);

    Route::get('util/gif/{path}', [
        'uses' => 'UtilController@gif',
        'as' => 'logs'
    ])->where(['path' => '.*']);
});

// === HQ ==================================================================

Route::get('hq/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

// Scaffold dashboard
Route::get('hq', 'Hq\ScaffoldController@dashboard')->name('scaffold.dashboard');

// Scaffolding plugin for models
Route::resource('hq/scaffold', 'Hq\ScaffoldController', ['names' => [
        'index' => config('scaffold.route-base-name') . '.index',
        'show' => config('scaffold.route-base-name') . '.show',
        'create' => config('scaffold.route-base-name') . '.create',
        'store' => config('scaffold.route-base-name') . '.store',
        'edit' => config('scaffold.route-base-name') . '.edit',
        'update' => config('scaffold.route-base-name') . '.update',
        'destroy' => config('scaffold.route-base-name') . '.destroy',
]]);

// Generator
Route::get('hq/generator', [
    'uses' => 'GeneratorController@generateWorld'
]);

Route::get('person/assign-job-idle/{id}', 'PersonController@assignJobIdle')->name('person.assign-job.idle');
Route::get('person/assign-job-craft/{id}', 'PersonController@assignJobCraft')->name('person.assign-job.craft');
Route::get('person/assign-job-explore/{id}', 'PersonController@assignJobExplore')->name('person.assign-job.explore');
