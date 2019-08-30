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

//Admin-AREAS
Route::get('/AdminArea', 'AdministradorController@area')->name('AdminArea');
Route::post('/AdminArea/create', 'AdminGuardarController@AreaCreate');
Route::post('/AdminArea/edit', 'AdminActualizarController@areaEditar');
Route::get('/AdminArea/{id}/delete', 'AdminEliminarController@areaDelete');

//Admin-NIVELES
Route::get('/AdminNivel', 'AdministradorController@nivel')->name('AdminNivel');
Route::post('/AdminNiveles/create', 'AdminGuardarController@NivelesCreate');
Route::post('/AdminNiveles/edit', 'AdminActualizarController@nivelEditar');
Route::get('/AdminNiveles/{id}/delete', 'AdminEliminarController@niveleDelete');

//Admin-TURNOS
Route::get('/AdminTurno', 'AdministradorController@turno')->name('AdminTurno');
Route::post('/AdminTurnos/create', 'AdminGuardarController@TurnosCreate');
Route::post('/AdminTurnos/edit', 'AdminActualizarController@turnoEditar');
Route::get('/AdminTurnos/{id}/delete', 'AdminEliminarController@turnoDelete');

//Admin-GESTION
Route::get('/AdminGestion', 'AdministradorController@gestion')->name('AdminGestion');
Route::post('/AdminGestion/create', 'AdminGuardarController@GestionCreate');
Route::post('/AdminGestion/edit', 'AdminActualizarController@gestionEditar');
Route::get('/AdminGestion/{id}/delete', 'AdminEliminarController@gestionDelete');
Route::get('/CerrarGestion', 'AdminActualizarController@gestionClose');

//Admin-TIPO CALIFICAION
Route::get('/AdminTipoCalificacion', 'AdministradorController@tipocalificacion')->name('AdminTipoCalificacion');
Route::post('/AdminTipoCalificacion/create', 'AdminGuardarController@TcalificacionCreate');
Route::post('/AdminTipoCalificacion/edit', 'AdminActualizarController@TcalificacionEditar');
Route::get('/AdminTipoCalificacion/{id}/delete', 'AdminEliminarController@TcalificacionDelete');

//Admin-MATERIA
Route::get('/AdminMateria', 'AdministradorController@materia')->name('AdminMateria');
Route::post('/AdminMateria/create', 'AdminGuardarController@MateriaCreate');
Route::post('/Areas/fetch', 'FetchController@areasearch')->name('Areas.fetch');
Route::post('/AdminMateria/edit', 'AdminActualizarController@materiaEditar');
Route::get('/AdminMateria/{id}/delete', 'AdminEliminarController@materiaDelete');

//Admin-TUTOR
Route::get('/AdminTutor', 'AdministradorController@tutor')->name('AdminTutor');
Route::post('/AdminTutor/create', 'AdminGuardarController@TutorCreate');
Route::post('/AdminTutor/edit', 'AdminActualizarController@tutorEditar');
Route::get('/AdminTutor/{id}/delete', 'AdminEliminarController@tutorDelete');

//Admin-ALUMNO
Route::get('/AdminAlumno', 'AdministradorController@alumno')->name('AdminUser');
Route::post('/AdminAlumno/create', 'AdminGuardarController@AlumnoCreate');
Route::post('/AdminAlumno/complete', 'FetchController@tutorcomplete')->name('AdminAlumno.complete');
Route::post('/AdminAlumno/edit', 'AdminActualizarController@alumnoEditar');
Route::get('/AdminAlumno/{id}/delete', 'AdminEliminarController@alumnoDelete');

//Admin-PROFESOR
Route::get('/AdminProfesor', 'AdministradorController@profesor')->name('AdminProfesor');
Route::post('/AdminProfesor/create', 'AdminGuardarController@ProfesorCreate');
Route::post('/AdminProfesor/edit', 'AdminActualizarController@profesorEditar');
Route::get('/AdminProfesor/{id}/delete', 'AdminEliminarController@profesorDelete');

//Admin-CURSOS
Route::get('/AdminCurso', 'AdministradorController@curso')->name('AdminCurso');
Route::post('/AdminCursos/create', 'AdminGuardarController@CursosCreate');
Route::post('/nivel/fetch', 'FetchController@nivelsearch')->name('nivel.fetch');
Route::post('/AdminCursos/edit', 'AdminActualizarController@cursoEditar');
Route::get('/AdminCursos/{id}/delete', 'AdminEliminarController@cursoDelete');

//Admin-PARALELO
Route::get('/AdminParalelo', 'AdministradorController@paralelo')->name('AdminParalelo');
Route::post('/AdminParalelos/create', 'AdminGuardarController@ParalelosCreate');
Route::post('/turno/fetch', 'FetchController@turnosearch')->name('turno.fetch');
Route::post('/curso/fetch', 'FetchController@cursosearch')->name('curso.fetch');
Route::post('/gestion/fetch', 'FetchController@gestionsearch')->name('gestion.fetch');
Route::post('/AdminParalelos/edit', 'AdminActualizarController@paraleloEditar');
Route::get('/AdminParalelos/{id}/delete', 'AdminEliminarController@paralelosDelete');

//Admin-INSCRIPCION
Route::get('/AdminInscripcion', 'AdministradorController@inscripcion')->name('AdminInscripcion');
Route::post('/AdminInscripcion/create', 'AdminGuardarController@InscripcionCreate');
Route::post('/AdminAlumno/fetch', 'FetchController@alumnosearch')->name('AdminAlumno.fetch');
Route::post('/AdminParalelo/fetch', 'FetchController@paralelocomplete')->name('AdminParalelo.fetch');
Route::post('/AdminInscripcion/edit', 'AdminActualizarController@inscripcionEditar');
Route::get('/AdminInscripcion/{id}/delete', 'AdminEliminarController@inscripcionDelete');

//Admin-MATERIA CURSOS
Route::get('/AdminMateriaCursos', 'AdministradorController@materiaCursos')->name('AdminMateriaCursos');

Route::post('/AdminMateria/fetch', 'FetchController@materiacomplete')->name('AdminMateria.fetch');
Route::post('/AdminCursos/fetch', 'FetchController@cursosRestantes')->name('AdminCursos.fetch');
Route::post('/AdminCurso/complte', 'FetchController@cursocomplete')->name('AdminCurso.complte');
Route::post('/AdminMateriaCursos/create', 'AdminGuardarController@materiaCursosCreate');
Route::post('/AdminMateriaCursos/edit', 'AdminActualizarController@materiaCursosEditar');
Route::get('/AdminMateriaCursos/{id}/delete', 'AdminEliminarController@materiaCursosDelete');

//Admin-ASIGNAR MATERIA
Route::get('/AdminAsignarMateria', 'AdministradorController@asignarMateria')->name('AdminAsignarMateria');
Route::get('/AdminAsignarMaterias/{id}', 'AdministradorController@asignarMaterias')->name('AdminAsignarMaterias');

Route::post('/AdminProfesor/fetch', 'FetchController@profesorsearch')->name('AdminProfesor.fetch');
Route::post('/AdminAsignarMaterias/create', 'AdminGuardarController@asignarMateriaCreate');
Route::post('/Materias/filter', 'FetchController@materiafilter')->name('Materias.filter');
Route::post('/AdminAsignarMaterias/edit', 'AdminActualizarController@asignarMateriaEditar');
Route::get('/AdminAsignarMaterias/{id}/delete', 'AdminEliminarController@asignarmateriaDelete');

//PROFESOR
Route::get('/Profesor', 'ProfesorController@index');
Route::post('/Profesor/Curso', 'ProfesorController@profesorCurso')->name('Profesor.Curso');
Route::post('/ProfesorNota/edit', 'ProfesorController@notaEditar')->name('ProfesorNota.edit');

Route::get('/Contador', 'ContadorController@index');
Route::post('/Contador/monto', 'ContadorController@monto');
Route::get('/Contador/inicio', 'ContadorController@inicio')->name('Contador.inicio');
Route::post('/Contador/alumnos', 'ContadorController@contadorAlumno')->name('Contador.alumnos');
Route::post('/Contador/edit', 'ContadorController@cuotaEditar')->name('Contador.edit');
//Route::get('/Regente', function () { return view('Regente'); });
Route::get('/Padre', 'TutorController@index');
Route::post('/Tutor/Alumno', 'TutorController@tutoAlumno')->name('Tutor.Alumno');
Route::post('/Alumno/Comportamiento', 'TutorController@alumnoComportamiento')->name('Alumno.Comportamiento');







