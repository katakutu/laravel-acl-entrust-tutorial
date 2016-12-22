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
		->middleware('role:root');
	Route::get('roles/create', 'RoleController@create')
		->name('roles.create');

	Route::post('roles/create', 'RoleController@store')
		->name('roles.store');
		
	Route::get('roles/{id}', 'RoleController@show')
		->name('roles.show');
	Route::get('roles/{id}/edit', 'RoleController@edit')
		->name('roles.edit');
		// ->middleware('permission:role-edit');
	Route::patch('roles/{id}', 'RoleController@update')
		->name('roles.update');
		// ->middleware('permission:role-edit');
	Route::delete('roles/{id}', 'RoleController@delete')
		->name('roles.delete')
		->middleware('permission:role-delete');

	Route::get('items', 'ItemController@index')
		->name('items.index')
		->middleware('permission:item-list|item-create|item-edit|item-delete');
	Route::get('items/create', 'ItemController@create')
		->name('items.create')
		->middleware('permission:item-create');
	Route::post('items/store', 'ItemController@store')
		->name('items.store')
		->middleware('permission:item-create');
	Route::get('items/{id}', 'ItemController@show')
		->name('items.show');
	Route::get('items/{id}/edit', 'ItemController@edit')
		->name('items.edit')
		->middleware('permission:item-edit');
	Route::patch('items/{id}', 'ItemController@update')
		->name('items.update')
		->middleware('permission:item-edit');
	Route::delete('items/{id}', 'ItemController@delete')
		->name('items.delete')
		->middleware('permission:item-delete');
});


