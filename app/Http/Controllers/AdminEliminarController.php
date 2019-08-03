<?php

namespace App\Http\Controllers;

use App\Areas;
use App\Gestiones;
use App\Niveles;
use App\TipoCalificaciones;
use App\Turnos;
use Illuminate\Database\QueryException;

class AdminEliminarController extends Controller
{
    public function areaDelete($id)
    {
        try {
            $area = Areas::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Areas::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }

    }

    public function niveleDelete($id)
    {
        try {
            $area = Niveles::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Niveles::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function turnoDelete($id)
    {
        try {
            $area = Turnos::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Turnos::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function gestionDelete($id)
    {
        try {
            $area = Gestiones::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Gestiones::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function TcalificacionDelete($id)
    {
        try {
            $area = TipoCalificaciones::find($id);
            $area->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = TipoCalificaciones::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }
}
