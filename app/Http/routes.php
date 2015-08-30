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

Route::get('test', function(){
	dd(App\User::first());

});



Route::get('test2', function(){
	$pdf = PDF::loadView('layouts.pdf');
	return $pdf->stream('download.pdf');;
});


