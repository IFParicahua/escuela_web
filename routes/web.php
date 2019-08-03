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
Route::post('/AdminArea/create', 'AdministradorController@AreaCreate');
Route::post('/AdminArea/edit', 'AdministradorController@areaEditar');
Route::get('/AdminArea/{id}/delete', 'AdministradorController@areaDelete');

//NIVELES
Route::get('/AdminNivel', 'AdministradorController@nivel')->name('AdminNivel');
Route::post('/AdminNiveles/create', 'AdministradorController@NivelesCreate');
Route::post('/AdminNiveles/edit', 'AdministradorController@nivelEditar');
Route::get('/AdminNiveles/{id}/delete', 'AdministradorController@niveleDelete');

//TURNOS
Route::get('/AdminTurno', 'AdministradorController@turno')->name('AdminTurno');
Route::post('/AdminTurnos/create', 'AdministradorController@TurnosCreate');
Route::post('/AdminTurnos/edit', 'AdministradorController@turnoEditar');
Route::get('/AdminTurnos/{id}/delete', 'AdministradorController@turnoDelete');

//GESTION
Route::get('/AdminGestion', 'AdministradorController@gestion')->name('AdminGestion');
Route::post('/AdminGestion/create', 'AdministradorController@GestionCreate');
Route::post('/AdminGestion/edit', 'AdministradorController@gestionEditar');
Route::get('/AdminGestion/{id}/delete', 'AdministradorController@gestionDelete');
Route::get('/CerrarGestion', 'AdministradorController@gestionClose');

//TIPO CALIFICAION
Route::get('/AdminTipoCalificacion', 'AdministradorController@tipocalificacion')->name('AdminTipoCalificacion');
Route::post('/AdminTipoCalificacion/create', 'AdministradorController@TcalificacionCreate');
Route::post('/AdminTipoCalificacion/edit', 'AdministradorController@TcalificacionEditar');
Route::get('/AdminTipoCalificacion/{id}/delete', 'AdministradorController@TcalificacionDelete');
//
//Route::get('/Contador', function () { return view('Contador'); });
//Route::get('/Regente', function () { return view('Regente'); });
//Route::get('/Profesor', function () { return view('Profesor'); });
//Route::get('/Padre', function () { return view('Padre'); });







