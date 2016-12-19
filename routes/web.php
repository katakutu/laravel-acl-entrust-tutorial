<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'HomeController@index');

	Route::resource('users', 'UserController');

	Route::get('roles', 'RoleController@index')
		->name('roles.index')
		->middleware('permission:role-list|role-create|role-edit|role-delete');
	Route::get('roles/create', 'RoleController@create')
		->name('roles.create')
		->middleware('permission:role-create');
});
