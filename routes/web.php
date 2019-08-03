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
Route::get('/CerrarGestion', 'AdministradorController@gestionClose');

//TIPO CALIFICAION
Route::get('/AdminTipoCalificacion', 'AdministradorController@tipocalificacion')->name('AdminTipoCalificacion');
Route::post('/AdminTipoCalificacion/create', 'AdminGuardarController@TcalificacionCreate');
Route::post('/AdminTipoCalificacion/edit', 'AdminActualizarController@TcalificacionEditar');
Route::get('/AdminTipoCalificacion/{id}/delete', 'AdminEliminarController@TcalificacionDelete');
//
//Route::get('/Contador', function () { return view('Contador'); });
//Route::get('/Regente', function () { return view('Regente'); });
//Route::get('/Profesor', function () { return view('Profesor'); });
//Route::get('/Padre', function () { return view('Padre'); });







