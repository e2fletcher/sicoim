<?php

Route::get('/', 'HomeController@index');

/**
 * Modulos encargados de la autentificación y registro
 * de usuarios en el sistema
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);

/**
 * Modulos encargados de 
 * gestionar los tipos de productos
 */
Route::get('tipos', 'TiposController@index');

Route::post('tipos/create', 'TiposController@create');
Route::post('tipos/update', 'TiposController@update');
Route::get('tipos/destroy', 'TiposController@destroy');

/**
 * Modulos proveedores
 */
Route::get('provedors/search', 'ProvedorsController@search');

/**
 * Modulos encargados de las recepciones de productos
 */
Route::get('recepcions', 'RecepcionsController@index');
Route::post('recepcions/create', 'RecepcionsController@create');

/**
 * Rutas a paginas de pruebas
 */
Route::get('test', function(){
	$user = App\User::first();
	dd($user->hasRole('edit_tipos'));
});


Route::get('test3', 'TestController@index')->middleware('role:gerente');

Route::get('test2', function(){
	$pdf = PDF::loadView('layouts.pdf');
	return $pdf->stream('download.pdf');;
});


