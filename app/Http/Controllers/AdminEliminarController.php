<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Areas;
use App\AsignarMaterias;
use App\CursoParalelos;
use App\Cursos;
use App\Gestiones;
use App\Inscripciones;
use App\MateriaCursos;
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

    public function inscripcionDelete($id)
    {
        try {
            $inscripciones = Inscripciones::find($id);
            $inscripciones->delete();
            return back();
        } catch (QueryException $e) {
            $inscripcion = Inscripciones::find($id);
            $nombre = $inscripcion->inscripcionAlumno->alumnoPersona->nombre . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidopat . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidomat;
            $curso = $inscripcion->inscripcionParalelo->paraleloCurso->nombre . ' ' . $inscripcion->inscripcionParalelo->nombre . ' de ' . $inscripcion->inscripcionParalelo->paraleloCurso->cursoNivel->nombre;
            $notificacion = array(
                'message' => 'La inscripcion de ' . $nombre . ' en el curso ' . $curso . ' no se puede eliminar.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function materiaCursosDelete($id)
    {
        try {
            $materiacurso = MateriaCursos::find($id);
            $materiacurso->delete();
            return back();
        } catch (QueryException $e) {
            $materiacurso = MateriaCursos::find($id);
            $curso = $materiacurso->materiaCurso->nombre . ' de ' . $materiacurso->materiaCurso->cursoNivel->nombre;
            $materia = $materiacurso->materiaMateria->nombre;
            $notificacion = array(
                'message' => $materia . ' no se puede eliminar del curso ' . $curso,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function asignarmateriaDelete($id)
    {
        try {
            $materiacurso = AsignarMaterias::find($id);
            $materiacurso->delete();
            return back();
        } catch (QueryException $e) {
            $notificacion = array(
                'message' => 'No se puede eliminar este dato',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

}
