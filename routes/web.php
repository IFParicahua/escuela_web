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

Route::get('/', function () {
    return view('login');
});

Route::post('login', 'LoginController@login')->name('login');
Route::post('/logout', 'LoginController@logout')->name('logout');

Route::get('/inicio', 'LoginController@inicio')->name('inicio');
Route::get('rol/{id}', 'LoginController@redirect')->name('rol');

Route::get('/Administrador', 'AdministradorController@index');

//AREAS
Route::get('/AdminArea', 'AdministradorController@area')->name('AdminArea');
Route::post('/AdminArea/create', 'AdminGuardarController@AreaCreate');
Route::post('/AdminArea/edit', 'AdminActualizarController@areaEditar');
Route::get('/AdminArea/{id}/delete', 'AdminEliminarController@areaDelete');

//NIVELES
Route::get('/AdminNivel', 'AdministradorController@nivel')->name('AdminNivel');
Route::post('/AdminNiveles/create', 'AdminGuardarController@NivelesCreate');
Route::post('/AdminNiveles/edit', 'AdminActualizarController@nivelEditar');
Route::get('/AdminNiveles/{id}/delete', 'AdminEliminarController@niveleDelete');

//TURNOS
Route::get('/AdminTurno', 'AdministradorController@turno')->name('AdminTurno');
Route::post('/AdminTurnos/create', 'AdminGuardarController@TurnosCreate');
Route::post('/AdminTurnos/edit', 'AdminActualizarController@turnoEditar');
Route::get('/AdminTurnos/{id}/delete', 'AdminEliminarController@turnoDelete');

//GESTION
Route::get('/AdminGestion', 'AdministradorController@gestion')->name('AdminGestion');
Route::post('/AdminGestion/create', 'AdminGuardarController@GestionCreate');
Route::post('/AdminGestion/edit', 'AdminActualizarController@gestionEditar');
Route::get('/AdminGestion/{id}/delete', 'AdminEliminarController@gestionDelete');
Route::get('/CerrarGestion', 'AdminActualizarController@gestionClose');

//TIPO CALIFICAION
Route::get('/AdminTipoCalificacion', 'AdministradorController@tipocalificacion')->name('AdminTipoCalificacion');
Route::post('/AdminTipoCalificacion/create', 'AdminGuardarController@TcalificacionCreate');
Route::post('/AdminTipoCalificacion/edit', 'AdminActualizarController@TcalificacionEditar');
Route::get('/AdminTipoCalificacion/{id}/delete', 'AdminEliminarController@TcalificacionDelete');

////MATERIA
Route::get('/AdminMateria', 'AdministradorController@materia')->name('AdminMateria');
Route::post('/AdminMateria/create', 'AdminGuardarController@MateriaCreate');
Route::post('/Areas/fetch', 'FetchController@areasearch')->name('Areas.fetch');
Route::post('/AdminMateria/edit', 'AdminActualizarController@materiaEditar');
Route::get('/AdminMateria/{id}/delete', 'AdminEliminarController@materiaDelete');

////TUTOR
Route::get('/AdminTutor', 'AdministradorController@tutor')->name('AdminTutor');
Route::post('/AdminTutor/create', 'AdminGuardarController@TutorCreate');
Route::post('/AdminTutor/edit', 'AdminActualizarController@tutorEditar');
Route::get('/AdminTutor/{id}/delete', 'AdminEliminarController@tutorDelete');

////ALUMNO
Route::get('/AdminAlumno', 'AdministradorController@alumno')->name('AdminUser');
Route::post('/AdminAlumno/create', 'AdminGuardarController@AlumnoCreate');
Route::post('/AdminAlumno/complete', 'FetchController@tutorcomplete')->name('AdminAlumno.complete');
Route::post('/AdminAlumno/edit', 'AdminActualizarController@alumnoEditar');
Route::get('/AdminAlumno/{id}/delete', 'AdminEliminarController@alumnoDelete');

////PROFESOR
Route::get('/AdminProfesor', 'AdministradorController@profesor')->name('AdminProfesor');
Route::post('/AdminProfesor/create', 'AdminGuardarController@ProfesorCreate');
Route::post('/AdminProfesor/edit', 'AdminActualizarController@profesorEditar');
Route::get('/AdminProfesor/{id}/delete', 'AdminEliminarController@profesorDelete');

////CURSOS
Route::get('/AdminCurso', 'AdministradorController@curso')->name('AdminCurso');
Route::post('/AdminCursos/create', 'AdminGuardarController@CursosCreate');
Route::post('/nivel/fetch', 'FetchController@nivelsearch')->name('nivel.fetch');
Route::post('/AdminCursos/edit', 'AdminActualizarController@cursoEditar');
Route::get('/AdminCursos/{id}/delete', 'AdminEliminarController@cursoDelete');

//PARALELO
Route::get('/AdminParalelo', 'AdministradorController@paralelo')->name('AdminParalelo');
Route::post('/AdminParalelos/create', 'AdminGuardarController@ParalelosCreate');
Route::post('/turno/fetch', 'FetchController@turnosearch')->name('turno.fetch');
Route::post('/curso/fetch', 'FetchController@cursosearch')->name('curso.fetch');
Route::post('/gestion/fetch', 'FetchController@gestionsearch')->name('gestion.fetch');
Route::post('/AdminParalelos/edit', 'AdminActualizarController@paraleloEditar');
Route::get('/AdminParalelos/{id}/delete', 'AdminEliminarController@paralelosDelete');

//INSCRIPCION
Route::get('/AdminInscripcion', 'AdministradorController@inscripcion')->name('AdminInscripcion');
Route::post('/AdminInscripcion/create', 'AdminGuardarController@InscripcionCreate');
Route::post('/AdminAlumno/fetch', 'FetchController@alumnosearch')->name('AdminAlumno.fetch');
Route::post('/AdminParalelo/fetch', 'FetchController@paralelocomplete')->name('AdminParalelo.fetch');
Route::post('/AdminInscripcion/edit', 'AdminActualizarController@inscripcionEditar');
Route::get('/AdminInscripcion/{id}/delete', 'AdminEliminarController@inscripcionDelete');

//ASIGNAR MATERIA
Route::get('/AdminAsignarMateria', 'AdministradorController@asignarMateria')->name('AdminAsignarMateria');
Route::get('/AdminAsignarMaterias/{id}', 'AdministradorController@asignarMaterias')->name('AdminAsignarMaterias');

//
//Route::get('/Contador', function () { return view('Contador'); });
//Route::get('/Regente', function () { return view('Regente'); });
//Route::get('/Profesor', function () { return view('Profesor'); });
//Route::get('/Padre', function () { return view('Padre'); });







