<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Ruta predeterminada para acceder automatica
Route::get('/', 'UsuariosController@acceder');
Route::get('origen', 'UsuariosController@origen');
Route::get('filosofia', 'UsuariosController@filosofia');
Route::get('mision', 'UsuariosController@mision');
Route::get('vision', 'UsuariosController@vision');
Route::get('valores', 'UsuariosController@valores');
Route::get('como_somos', 'UsuariosController@como_somos');
Route::get('referencia', 'UsuariosController@referencia');



Route::get('registrar', 'UsuariosController@registrar');
Route::get('activar/{random}', 'UsuariosController@activar');
Route::get('acceder', 'UsuariosController@acceder');
Route::get('salir', 'UsuariosController@salir');
Route::get('administrar', 'UsuariosController@administrar');
Route::get('editar', 'UsuariosController@editar');
Route::get('editar_pass', 'UsuariosController@editar_pass');

Route::post('validar', 'UsuariosController@validar');
Route::post('registrar', 'UsuariosController@registrar_db');
Route::post('editar', 'UsuariosController@actualizar');
Route::post('editar_pass', 'UsuariosController@actualizar_pass');