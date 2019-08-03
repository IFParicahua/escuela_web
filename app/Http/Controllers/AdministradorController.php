<?php

namespace App\Http\Controllers;


use App\Areas;
use App\Gestiones;
use App\Niveles;
use App\TipoCalificaciones;
use App\Turnos;

class AdministradorController extends Controller
{
    //VISTAS
    public function index()
    {
        return view('Administrador');
    }

    public function area()
    {
        $areas = Areas::all();
        return view('AdminAreas', ['areas' => $areas]);
    }

    public function nivel()
    {
        $niveles = Niveles::all();
        return view('AdminNiveles', ['niveles' => $niveles]);
    }

    public function turno()
    {
        $turnos = Turnos::all();
        return view('AdminTurnos', ['turnos' => $turnos]);
    }

    public function gestion()
    {
        $gestiones = Gestiones::all();
        return view('AdminGestiones', ['gestiones' => $gestiones]);
    }

    public function tipocalificacion()
    {
        $TCalificaciones = TipoCalificaciones::all();
        return view('AdminTipoCalificaciones', ['TCalificaciones' => $TCalificaciones]);
    }

}
