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
use App\TipoCalificaciones;
use App\Turnos;
use Illuminate\Http\Request;
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
            $area = Areas::find($id);
            $area->nombre = $nombre;
            $area->save();
            return back();
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
            $nivel = Niveles::find($id);
            $nivel->nombre = $nombre;
            $nivel->save();
            return back();
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
            $turno = Turnos::find($id);
            $turno->nombre = $nombre;
            $turno->save();
            return back();
        }
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
        $nombre = $request->input('editnombre');
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
            $tipo = TipoCalificaciones::find($id);
            $tipo->nombre = $nombre;
            $tipo->save();
            return back();
        }
    }
    public function gestionClose()
    {
        $id = Gestiones::max('id');
        $gestion = Gestiones::find($id);
        $gestion->estado = '1';
        $gestion->save();
        return back();
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
            $materia = Materias::find($id);
            $materia->nombre = $nombre;
            $materia->id_area = $idarea;
            $materia->estado = '0';
            $materia->save();
            return back();
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
            $persona = Personas::find($id);
            $persona->nombre = $request->input('editnombre');
            $persona->apellidopat = $request->input('editapaterno');
            $persona->apellidomat = $request->input('editamaterno');
            $persona->direccion = $request->input('editdireccion');
            $persona->ci = $request->input('editci');
            $persona->telefono = $request->input('edittelefono');
            $persona->sexo = $request->input('editsexo');
            $persona->save();
            return back();
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
            return back();
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
            $persona = Personas::find($id);
            $persona->nombre = $request->input('editnombre');
            $persona->apellidopat = $request->input('editpaterno');
            $persona->apellidomat = $request->input('editmaterno');
            $persona->direccion = $request->input('editdireccion');
            $persona->ci = $request->input('editci');
            $persona->telefono = $request->input('edittelefono');
            $persona->sexo = $request->input('editsexo');
            $persona->save();
            return back();
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
            $curso = Cursos::find($id);
            $curso->nombre = $nombre;
            $curso->grado = $request->input('editgrado');
            $curso->id_nivel = $idnivel;
            $curso->save();
            return back();
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
            $paralelo = CursoParalelos::find($id);
            $paralelo->id_gestion = $idgestion;
            $paralelo->id_turno = $idturno;
            $paralelo->id_curso = $idcurso;
            $paralelo->nombre = $nombre;
            $paralelo->cupo_maximo = $cupo;
            $paralelo->save();
            return back();
        }
    }
}

