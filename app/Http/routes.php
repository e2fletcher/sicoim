<?php

Route::get('/', function () {
	return view('index');
});

Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('tipos', 'TiposController@index');
Route::post('tipos/create', 'TiposController@create');
Route::post('tipos/update', 'TiposController@update');
Route::get('tipos/destroy', 'TiposController@destroy');
