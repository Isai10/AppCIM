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
Route::get('mainUsuario','MainUsuario@principalUsuario')->name('mainUsuario')->middleware('verified');
Route::get('mainDocente','PagesController@principalMaestro')->name('mainMaestro')->middleware('verified');
Route::get('cursoAlumno/{idCurso}/{idUser}','ContentCursoAlumnoController@cursoAlumno')->name('cursoAlumno');
Route::get('cursoDocente/{idCurso}/{idUser}','PagesController@cursoProfesor')->name('cursoProfesor');
Route::get('crearExamen','PagesController@crearExamen')->name('crearExamen')->middleware('verified');
Route::get('crearPregunta','PagesController@crearPregunta')->name('crearPregunta')->middleware('verified');
Route::get('mainUsuario/masCursos','MainUsuario@masCursos')->name('curso.mas')->middleware('verified');
Route::get('mainUsuario/addCurso/{id?}/{iduser?}','MainUsuario@addCurso')->name('curso.add');
Route::post('mainUsuario/crearCurso','PagesControllerMaestro@crearCurso')->name('curso.crear');
Route::get('mainUsuario/quitarCurso/{id?}/{idUser?}','MainUsuario@quitarCurso')->name('curso.alumn.quit');
Route::get('mainUsuario/eliminarCurso/{id?}/{idUser?}','PagesControllerMaestro@eliminarCurso')->name('curso.prof.delete');
Route::get('mainUsuario/Curso/actividad/{idCurso}/{idUser}','ActividadesController@actividad')->name('curso.actividad');
Route::post('mainUsuario/Curso/actividad/crear/{idCurso}','ActividadesController@crearActividad')->name('curso.actividad.crear');
Route::get('mainUsuario/Curso/actividad/eliminar/{idAct}/{tipo}/{idGen}','ActividadesController@eliminarActividad')->name('curso.actividad.eliminar');
Route::get('mainUsuario/Curso/actividad/editar/{idAct?}/{idTipo}/{idActGen}','ActividadesController@editarActividad')->name('curso.actividad.editar');
Route::post('mainUsuario/Curso/actividad/examen/preguntas/crear/{idPreg}','ExamenController@crearPregunta')->name('curso.actividad.examen.pregunta.crear');
Route::get('mainUsuario/Curso/actividad/examen/preguntas/eliminar/{idPreg}','ExamenController@eliminarPregunta')->name('curso.actividad.examen.pregunta.eliminar');
Route::get('mainUsuario/Curso/actividad/examen/comenzar/{idExam}','ExamenController@examen')->name('curso.actividad.examen');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
