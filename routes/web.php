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

Route::get('/','PagesController@inicio')->name('inicio');
Route::get('inicioSesion','PagesController@inicioSesion')->name('inicioSesion');
Route::get('registroUsuario','PagesController@registroUsuario')->name('registroUsuario');
Route::get('mainUsuario','PagesController@principalUsuario')->name('mainUsuario');
Route::get('mainDocente','PagesController@principalMaestro')->name('mainMaestro');
Route::get('cursoAlumno','ContentCursoAlumnoController@cursoAlumno')->name('cursoAlumno');
Route::get('cursoDocente','PagesController@cursoProfesor')->name('cursoProfesor');
Route::get('crearExamen','PagesController@crearExamen')->name('crearExamen');
Route::get('crearPregunta','PagesController@crearPregunta')->name('crearPregunta');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
