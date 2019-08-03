<?php

namespace App\Http\Controllers;

use App\Areas;
use App\Gestiones;
use App\Niveles;
use App\TipoCalificaciones;
use App\Turnos;
use Illuminate\Http\Request;

class AdminActualizarController extends Controller
{
    public function areaEditar(Request $request)
    {
        $id = $request->input('pkarea');
        $area = Areas::find($id);
        $area->nombre = $request->input('editnombre');
        $area->save();
        return back();
    }

    public function nivelEditar(Request $request)
    {
        $id = $request->input('pknivel');
        $nivel = Niveles::find($id);
        $nivel->nombre = $request->input('editnombre');
        $nivel->save();
        return back();
    }

    public function turnoEditar(Request $request)
    {
        $id = $request->input('pkturno');
        $turno = Turnos::find($id);
        $turno->nombre = $request->input('editnombre');
        $turno->save();
        return back();
    }

    public function gestionEditar(Request $request)
    {
        $id = $request->input('pkgestion');
        $gestion = Gestiones::find($id);
        $gestion->descripcion = $request->input('editdescripcion');
        $gestion->save();
        return back();
    }

    public function TcalificacionEditar(Request $request)
    {
        $id = $request->input('pkTCalificacion');
        $tipo = TipoCalificaciones::find($id);
        $tipo->nombre = $request->input('editnombre');
        $tipo->save();
        return back();
    }

    //Cerrar Desactivar
    public function gestionClose()
    {
        $id = Gestiones::max('id');
        $gestion = Gestiones::find($id);
        $gestion->estado = '1';
        $gestion->save();
        return back();
    }
}
