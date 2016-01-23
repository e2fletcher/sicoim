<?php

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');

/**
 * Modulos encargados de la autentificación y registro
 * de usuarios en el sistema
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' =>'auth/login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth/logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', ['as' => 'password/email', 'uses' => 'Auth\PasswordController@postEmail']);
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::group(['middleware' => 'auth'], function(){
    Route::get('password/change', 'Auth\PasswordController@getChangePassword');
    Route::post('password/change', ['as' => 'password/change', 'uses' => 'Auth\PasswordController@postChangePassword']);
    Route::group(['middleware' => 'auth_type:0'], function(){
        Route::get('auth/register', 'Auth\AuthController@getRegister');
        Route::post('auth/register', ['as' => 'auth/register', 'uses' => 'Auth\AuthController@postRegister']);
    });
});


/**
 * Modulos encargados de 
 * gestionar los tipos de productos
 */
Route::group(['prefix' => 'tipos'], function() {
	Route::group(['middleware' => 'auth'], function(){
		Route::group(['middleware' => 'auth_type:0'], function(){
			Route::get('/', 'TiposController@index');
			Route::post('create', 'TiposController@create');
			Route::post('update', 'TiposController@update');
			Route::get('destroy', 'TiposController@destroy');
		});
		Route::group(['middleware' => 'auth_type:1'], function(){
			Route::get('search', 'TiposController@search');
		});
	});
});

/**
 * Modulos encargados de 
 * gestionar los clientes
 */
Route::group(['prefix' => 'clientes'], function() {
    Route::group(['middleware' => 'auth'], function(){
        Route::group(['middleware' => 'auth_type:1'], function(){
	    Route::get('/', 'ClientesController@index');
    	    Route::post('create', 'ClientesController@create');
	    Route::post('update', 'ClientesController@update');
	    Route::get('destroy', 'ClientesController@destroy');
	    Route::get('search', 'ClientesController@search');
        });
    });
});


/**
 * Modulos encargados de 
 * gestionar los proveedores
 */
Route::group(['prefix' => 'proveedors'], function() {
    Route::group(['middleware' => ['auth', 'auth_type:1']], function(){
	Route::get('/', 'ProveedorsController@index');
	Route::get('/search', 'ProveedorsController@search');
	Route::post('create', 'ProveedorsController@create');
	Route::post('update', 'ProveedorsController@update');
	Route::get('destroy', 'ProveedorsController@destroy');
    });
});


/**
 * Modulos encargados de 
 * gestionar los sucursales
 */
Route::group(['prefix' => 'sucursals'], function() {
    Route::group(['middleware' => ['auth', 'auth_type:1']], function(){
	Route::get('/', 'SucursalsController@index');
	Route::post('create', 'SucursalsController@create');
	Route::post('update', 'SucursalsController@update');
	Route::get('destroy', 'SucursalsController@destroy');
	Route::get('search', 'SucursalsController@search');
    });
    Route::get('maps', 'SucursalsController@maps');
});

/**
 * Modulo de recepciones
 */
Route::group(['prefix' => 'recepcions'], function(){
    Route::group(['middleware' => ['auth', 'auth_type:1']], function(){
	Route::any('/', 'RecepcionsController@index');
	Route::post('process', 'RecepcionsController@process');
	Route::get('printer', 'RecepcionsController@printer');
	Route::get('search', 'RecepcionsController@search');
	Route::get('destroy', 'RecepcionsController@destroy');
    });
});


/**
 * Modulo de productos
 */
Route::group(['prefix' => 'productos'], function(){
    Route::group(['middleware' => ['auth', 'auth_type:1']], function(){
        Route::get('search', 'ProductosController@search');
    });
});

/**
 * Modulo de ventas
 */
Route::group(['prefix' => 'ventas'], function(){
    Route::group(['middleware' => ['auth', 'auth_type:1']], function(){
	Route::any('/', 'VentasController@index');
	Route::post('process', 'VentasController@process');
	Route::get('printer', 'VentasController@printer');
	Route::get('search', 'VentasController@search');
	Route::get('destroy', 'VentasController@destroy');
    });
});

/**
 * Modulo de transferencias
 */
Route::group(['prefix' => 'transferencias'], function(){
    Route::group(['middleware' => ['auth', 'auth_type:1']], function(){
	Route::any('/', 'TransferenciasController@index');
	Route::post('process', 'TransferenciasController@process');
        Route::get('printer', 'TransferenciasController@printer');
        Route::get('search', 'TransferenciasController@search');
        Route::get('destroy', 'TransferenciasController@destroy');
    });
});


/**
 * Modulos encargados de 
 * gestionar los productos
 */
Route::group(['prefix' => 'productos'], function() {
    Route::group(['middleware' => 'auth'], function(){
        Route::group(['middleware' => 'auth_type:1'], function(){
	    Route::get('/', 'ProductosController@index');
	});
    });
});
