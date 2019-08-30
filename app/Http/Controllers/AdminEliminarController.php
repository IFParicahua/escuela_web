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
use App\PersonaRoles;
use App\Personas;
use App\Profesores;
use App\TipoCalificaciones;
use App\Turnos;
use App\Tutores;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminEliminarController extends Controller
{
    public function areaDelete($id)
    {
        DB::beginTransaction();
        try {
            $area = Areas::find($id);
            $area->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $area = Niveles::find($id);
            $area->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $area = Turnos::find($id);
            $area->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $area = Gestiones::find($id);
            $area->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $area = TipoCalificaciones::find($id);
            $area->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $materia = Materias::find($id);
            $materia->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $tutor = Tutores::find($id);
            $tutor->delete();
            $iduser = User::where('id_persona', '=', $tutor->tutorPersona->id)->value('id');
            $user = User::find($iduser);
            $user->delete();
            $idrol = PersonaRoles::where('id_persona', '=', $tutor->tutorPersona->id)->value('id');
            $rol = PersonaRoles::find($idrol);
            $rol->delete();
            $persona = Personas::find($tutor->tutorPersona->id);
            $persona->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $tutor->tutorPersona->nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function alumnoDelete($id)
    {
        DB::beginTransaction();
        try {
            $alumno = Alumnos::find($id);
            $alumno->delete();
            $persona = Personas::find($alumno->alumnoPersona->id);
            $persona->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $alumno->alumnoPersona->nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function profesorDelete($id)
    {
        DB::beginTransaction();
        try {
            $profesor = Profesores::find($id);
            $profesor->delete();
            $iduser = User::where('id_persona', '=', $profesor->profesorPersona->id)->value('id');
            $user = User::find($iduser);
            $user->delete();
            $idrol = PersonaRoles::where('id_persona', '=', $profesor->profesorPersona->id)->value('id');
            $rol = PersonaRoles::find($idrol);
            $rol->delete();
            $persona = Personas::find($profesor->profesorPersona->id);
            $persona->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            $notificacion = array(
                'message' => 'No se pudo eliminar a ' . $profesor->profesorPersona->nombre,
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

    public function cursoDelete($id)
    {
        $curso = Cursos::find($id);
        $curso->estado = 1;
        $curso->save();
        return back();
    }

    public function paralelosDelete($id)
    {
        DB::beginTransaction();
        try {
            $paralelo = CursoParalelos::find($id);
            $paralelo->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $inscripciones = Inscripciones::find($id);
            $inscripciones->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $materiacurso = MateriaCursos::find($id);
            $materiacurso->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
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
        DB::beginTransaction();
        try {
            $materiacurso = AsignarMaterias::find($id);
            $materiacurso->delete();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            $notificacion = array(
                'message' => 'No se puede eliminar este dato',
                'alert-type' => 'error'
            );
            return back()->with($notificacion);
        }
    }

}
