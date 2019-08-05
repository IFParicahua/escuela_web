<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Areas;
use App\CursoParalelos;
use App\Cursos;
use App\Gestiones;
use App\Materias;
use App\Niveles;
use App\Personas;
use App\Profesores;
use App\TipoCalificaciones;
use App\Turnos;
use App\Tutores;
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

    public function materiaDelete($id)
    {
        try {
            $materia = Materias::find($id);
            $materia->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Materias::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function tutorDelete($id)
    {
        try {
            $tutor = Tutores::find($id);
            $tutor->delete();
            $persona = Personas::find($tutor->tutorPersona->id);
            $persona->delete();
            return back();
        } catch (QueryException $e) {
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $tutor->tutorPersona->nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function alumnoDelete($id)
    {
        try {
            $alumno = Alumnos::find($id);
            $alumno->delete();
            $persona = Personas::find($alumno->alumnoPersona->id);
            $persona->delete();
            return back();
        } catch (QueryException $e) {
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $alumno->alumnoPersona->nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function profesorDelete($id)
    {
        try {
            $profesor = Profesores::find($id);
            $profesor->delete();
            $persona = Personas::find($profesor->profesorPersona->id);
            $persona->delete();
            return back();
        } catch (QueryException $e) {
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $profesor->profesorPersona->nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function cursoDelete($id)
    {
        try {
            $curso = Cursos::find($id);
            $curso->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Materias::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function paralelosDelete($id)
    {
        try {
            $paralelo = CursoParalelos::find($id);
            $paralelo->delete();
            return back();
        } catch (QueryException $e) {
            $nombre = Materias::where('id', '=', $id)->value('nombre');
            $notificacion = array(
                'message' => 'No se pudo eliminar el paralelo ' . $nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

}
