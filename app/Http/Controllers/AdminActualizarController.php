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
use App\TipoCalificaciones;
use App\Turnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminActualizarController extends Controller
{
    public function areaEditar(Request $request)
    {
        $id = $request->input('pkarea');
        $nombre = $request->input('editnombre');
        $validar = Validator::make($request->all(), [
            'editnombre' => 'unique:areas,nombre,' . $id . ',id'
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => $nombre . ' ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $area = Areas::find($id);
                $area->nombre = $nombre;
                $area->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
    public function nivelEditar(Request $request)
    {

        $id = $request->input('pknivel');
        $nombre = $request->input('editnombre');
        $validar = Validator::make($request->all(), [
            'editnombre' => 'unique:niveles,nombre,' . $id . ',id'
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => $nombre . ' ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $nivel = Niveles::find($id);
                $nivel->nombre = $nombre;
                $nivel->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
    public function turnoEditar(Request $request)
    {

        $id = $request->input('pkturno');
        $nombre = $request->input('editnombre');
        $validar = Validator::make($request->all(), [
            'editnombre' => 'unique:turnos,nombre,' . $id . ',id'
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => $nombre . ' ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $turno = Turnos::find($id);
                $turno->nombre = $nombre;
                $turno->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
    public function gestionEditar(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->input('pkgestion');
            $gestion = Gestiones::find($id);
            $gestion->descripcion = $request->input('editdescripcion');
            $gestion->save();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        }

    }
    public function TcalificacionEditar(Request $request)
    {

        $id = $request->input('pkTCalificacion');
        $nombre = $request->input('editnombre');
        $inicio = $request->input('edit_inicio');
        $fin = $request->input('edit_fin');
        $validator = Validator::make($request->all(), [
            'editnombre' => 'unique:tipo_calificaciones,nombre,' . $id . ',id'
        ]);
        if ($validator->fails()) {
            $notificacion = array(
                'message' => $nombre . ' ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $tipo = TipoCalificaciones::find($id);
                $tipo->nombre = $nombre;
                $tipo->fecha_inicial = $inicio;
                $tipo->fecha_final = $fin;
                $tipo->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }

        }
    }
    public function gestionClose()
    {
        DB::beginTransaction();
        try {
            $id = Gestiones::max('id');
            $gestion = Gestiones::find($id);
            $gestion->estado = '1';
            $gestion->save();
            DB::commit();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        }
    }
    public function materiaEditar(Request $request)
    {

        $id = $request->input('pkmateria');
        $idarea = $request->input('editarea_id');
        $nombre = $request->input('editnombre');
        $validar = Validator::make($request->all(), [
            'editnombre' => [
                'required', Rule::unique('materias', 'nombre')->where(function ($query) use ($idarea) {
                    $query->where('id_area', $idarea);
                })->ignore($id, 'id')]
        ]);
        if ($validar->fails()) {
            $area = Areas::where('id', $idarea)->value('nombre');
            $notificacion = array(
                'message' => 'Ya existe ' . $nombre . ' en ' . $area,
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)->with('idarea', $idarea)->with('area', $area)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $materia = Materias::find($id);
                $materia->nombre = $nombre;
                $materia->id_area = $idarea;
                $materia->estado = '0';
                $materia->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }

        }
    }
    public function tutorEditar(Request $request)
    {

        $id = $request->input('PKpersona');
        $validar = Validator::make($request->all(), [
            'editci' => 'unique:personas,ci,' . $id . ',id'
        ]);
        if ($validar->fails()) {
            if ($request->input('editsexo') == 'M') {
                $dev_id_1 = 'M';
                $dev_id_2 = 'F';
                $dev_name_1 = 'Masculino';
                $dev_name_2 = 'Femenino';
            } else {
                $dev_id_1 = 'F';
                $dev_id_2 = 'M';
                $dev_name_1 = 'Femenino';
                $dev_name_2 = 'Masculino';
            }
            $notificacion = array(
                'message' => 'Este CI ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->with(compact('dev_id_1', 'dev_id_2', 'dev_name_1', 'dev_name_2'))
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $persona = Personas::find($id);
                $persona->nombre = $request->input('editnombre');
                $persona->apellidopat = $request->input('editapaterno');
                $persona->apellidomat = $request->input('editamaterno');
                $persona->direccion = $request->input('editdireccion');
                $persona->ci = $request->input('editci');
                $persona->telefono = $request->input('edittelefono');
                $persona->sexo = $request->input('editsexo');
                $persona->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
    public function alumnoEditar(Request $request)
    {

        $id = $request->input('pkpersona');
        $idAlumno = Alumnos::where('id_persona', $id)->value('id');
        $validar = Validator::make($request->all(), [
            'editci' => 'unique:personas,ci,' . $id . ',id',
            'editrude' => 'unique:alumnos,rude,' . $idAlumno . ',id'
        ]);
        if ($validar->fails()) {
            if ($request->input('editsexo') == 'M') {
                $dev_id_1 = 'M';
                $dev_id_2 = 'F';
                $dev_name_1 = 'Masculino';
                $dev_name_2 = 'Femenino';
            } else {
                $dev_id_1 = 'F';
                $dev_id_2 = 'M';
                $dev_name_1 = 'Femenino';
                $dev_name_2 = 'Masculino';
            }
            $notificacion = array(
                'message' => 'Este CI ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->with(compact('dev_id_1', 'dev_id_2', 'dev_name_1', 'dev_name_2'))
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $persona = Personas::find($id);
                $persona->nombre = $request->input('editnombre');
                $persona->apellidopat = $request->input('editpaterno');
                $persona->apellidomat = $request->input('editmaterno');
                $persona->direccion = $request->input('editdireccion');
                $persona->ci = $request->input('editci');
                $persona->telefono = $request->input('edittelefono');
                $persona->sexo = $request->input('editsexo');
                $persona->save();
                $alumno = Alumnos::find($idAlumno);
                $alumno->nacimiento = $request->input('editnacimiento');
                $alumno->idtutor = $request->input('editutor_id');
                $alumno->rude = $request->input('editrude');
                $alumno->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error' . $request->input('editutor_id') . '',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
    public function profesorEditar(Request $request)
    {

        $id = $request->input('pkpersona');
        $validar = Validator::make($request->all(), [
            'editci' => 'unique:personas,ci,' . $id . ',id'
        ]);
        if ($validar->fails()) {
            if ($request->input('editsexo') == 'M') {
                $dev_id_1 = 'M';
                $dev_id_2 = 'F';
                $dev_name_1 = 'Masculino';
                $dev_name_2 = 'Femenino';
            } else {
                $dev_id_1 = 'F';
                $dev_id_2 = 'M';
                $dev_name_1 = 'Femenino';
                $dev_name_2 = 'Masculino';
            }
            $notificacion = array(
                'message' => 'Este CI ya existe',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->with(compact('dev_id_1', 'dev_id_2', 'dev_name_1', 'dev_name_2'))
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $persona = Personas::find($id);
                $persona->nombre = $request->input('editnombre');
                $persona->apellidopat = $request->input('editpaterno');
                $persona->apellidomat = $request->input('editmaterno');
                $persona->direccion = $request->input('editdireccion');
                $persona->ci = $request->input('editci');
                $persona->telefono = $request->input('edittelefono');
                $persona->sexo = $request->input('editsexo');
                $persona->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }

        }
    }
    public function cursoEditar(Request $request)
    {

        $id = $request->input('pkcurso');
        $idnivel = $request->input('editnivel');
        $nombre = $request->input('editnombre');
        $validar = Validator::make($request->all(), [
            'editnombre' => [
                'required', Rule::unique('cursos', 'nombre')->where(function ($query) use ($idnivel) {
                    $query->where('id_nivel', $idnivel);
                })->ignore($id, 'id')]
        ]);
        if ($validar->fails()) {
            $area = Niveles::where('id', $idnivel)->value('nombre');
            $notificacion = array(
                'message' => 'Ya existe ' . $nombre . ' en ' . $area,
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)->with('idnivel', $idnivel)->with('nivel', $area)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $curso = Cursos::find($id);
                $curso->nombre = $nombre;
                $curso->grado = $request->input('editgrado');
                $curso->id_nivel = $idnivel;
                $curso->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }

        }
    }
    public function paraleloEditar(Request $request)
    {

        $id = $request->input('pkparalelo');
        $idgestion = $request->input('editgestion_id');
        $idturno = $request->input('editurno_id');
        $idcurso = $request->input('editcurso_id');
        $nombre = $request->input('editnombre');
        $cupo = $request->input('editcupo');

        $gestion = Gestiones::where('id', $idgestion)->value('nombre');
        $turno = Turnos::where('id', $idturno)->value('nombre');
        $cursos = Cursos::first()->where('id', '=', $idcurso)->get();
        $curso = $cursos[0]->nombre . ' de ' . $cursos[0]->cursoNivel->nombre;
        $validar = Validator::make($request->all(), [
            'editnombre' => [
                'required', Rule::unique('curso_paralelos', 'nombre')->where(function ($query) use ($idgestion, $idturno, $idcurso) {
                    $query->where([['id_gestion', $idgestion], ['id_turno', $idturno], ['id_curso', $idcurso]]);
                })->ignore($id, 'id')]
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => 'Ya existe el paralelo ' . $nombre . ' en la ' . $gestion . ' en turno ' . $turno . ' y el curso ' . $curso,
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)->with(compact('idgestion', 'idturno', 'idcurso', 'gestion', 'turno', 'curso'))
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $paralelo = CursoParalelos::find($id);
                $paralelo->id_gestion = $idgestion;
                $paralelo->id_turno = $idturno;
                $paralelo->id_curso = $idcurso;
                $paralelo->nombre = $nombre;
                $paralelo->cupo_maximo = $cupo;
                $paralelo->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
    public function inscripcionEditar(Request $request)
    {

        $id = $request->input('pkinscripcion');
        $idcurso = $request->input('edit_curso_id');
        $curso = $request->input('edit_curso_name');
        $idalumno = $request->input('edit_alumno_id');
        $alumno = $request->input('edit_alumno_name');
        $observacion = $request->input('edit_observacion');
        $validar = Validator::make($request->all(), [
            'edit_alumno_id' => [
                'required', Rule::unique('inscripciones', 'id_alumno')->where(function ($query) use ($idcurso) {
                    $query->where('id_cursos_paralelos', $idcurso);
                })->ignore($id, 'id')]
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => $alumno . ' ya fue inscrito en ' . $curso,
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $inscripcion = Inscripciones::find($id);
                $inscripcion->id_cursos_paralelos = $idcurso;
                $inscripcion->id_alumno = $idalumno;
                $inscripcion->observacion = $observacion;
                $inscripcion->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }

        }
    }
    public function materiaCursosEditar(Request $request)
    {

        $id = $request->input('pkcursomateria');
        $idcurso = $request->input('edit_curso_id');
        $curso = $request->input('edit_curso_name');
        $idmateria = $request->input('edit_materia_id');
        $materia = $request->input('edit_materia_name');
        $validar = Validator::make($request->all(), [
            'edit_materia_id' => [
                'required', Rule::unique('materia_cursos', 'id_materia')->where(function ($query) use ($idcurso) {
                    $query->where('id_curso', $idcurso);
                })->ignore($id, 'id')]
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => 'Ya existe ' . $materia . ' en el curso ' . $curso,
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $materia = MateriaCursos::find($id);
                $materia->id_curso = $idcurso;
                $materia->id_materia = $idmateria;
                $materia->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }

        }
    }
    public function asignarMateriaEditar(Request $request)
    {

        $id = $request->input('pkasignacion');
        $idParalelo = Session('paralelo-id');
        $idMateria = AsignarMaterias::where('id', '=', $id)->value('id_materia');
        $materia = Materias::where('id', $idMateria)->value('nombre');
        $idProfesor = $request->input('editar_profesor_id');
        $profesor = $request->input('editar_profesor_name');
        $validar = Validator::make($request->all(), [
            'editar_profesor_id' => [
                'required', Rule::unique('asignar_materias', 'id_profesores')->where(function ($query) use ($idMateria, $idParalelo) {
                    $query->where([['id_materia', $idMateria], ['id_cursos_paralelos', $idParalelo]]);
                })->ignore($id, 'id')]
        ]);
        if ($validar->fails()) {
            $notificacion = array(
                'message' => $materia . ' ya fue asignada a ' . $profesor,
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 2)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $asignar = AsignarMaterias::find($id);
                $asignar->id_profesores = $idProfesor;
                $asignar->save();
                DB::commit();
                return back();
            } catch (\Exception $e) {
                DB::rollback();
                $notificacion = array(
                    'message' => 'Ocurrio un error',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 2)
                    ->withInput();
            }
        }
    }
}

