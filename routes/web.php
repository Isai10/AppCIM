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
Route::get('mainUsuario','MainUsuario@principalUsuario')->name('mainUsuario');
Route::get('mainDocente','PagesController@principalMaestro')->name('mainMaestro');
Route::get('cursoAlumno/{idCurso}','ContentCursoAlumnoController@cursoAlumno')->name('cursoAlumno');
Route::get('cursoDocente/{idCurso}/{idUser}','PagesController@cursoProfesor')->name('cursoProfesor');
Route::get('crearExamen','PagesController@crearExamen')->name('crearExamen');
Route::get('crearPregunta','PagesController@crearPregunta')->name('crearPregunta');
Route::get('mainUsuario/masCursos','MainUsuario@masCursos')->name('curso.mas');
Route::get('mainUsuario/addCurso/{id?}/{iduser?}','MainUsuario@addCurso')->name('curso.add');
Route::post('mainUsuario/crearCurso','PagesControllerMaestro@crearCurso')->name('curso.crear');
Route::get('mainUsuario/quitarCurso/{id?}/{idUser?}','MainUsuario@quitarCurso')->name('curso.alumn.quit');
Route::get('mainUsuario/eliminarCurso/{id?}/{idUser?}','PagesControllerMaestro@eliminarCurso')->name('curso.prof.delete');
Route::get('mainUsuario/Curso/actividad','ActividadesController@actividad')->name('curso.actividad');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
