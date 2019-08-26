<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Areas;
use App\AsignarMaterias;
use App\Calificaciones;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminGuardarController extends Controller
{
    public function AreaCreate(Request $request)
    {

        try {
            $nombre = $request->input('nombre');
            $validar = Validator::make($request->all(), [
                'nombre' => 'unique:areas'
            ]);
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $nombre . ' ya existe',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $areas = new Areas;
                $areas->nombre = $nombre;
                $areas->estado = '0';
                $areas->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }
    }

    public function NivelesCreate(Request $request)
    {

        try {
            $nombre = $request->input('nombre');
            $validar = Validator::make($request->all(), [
                'nombre' => 'unique:niveles'
            ]);
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $nombre . ' ya existe',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $nivel = new Niveles;
                $nivel->nombre = $nombre;
                $nivel->estado = '0';
                $nivel->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function TurnosCreate(Request $request)
    {

        try {
            $nombre = $request->input('nombre');
            $validar = Validator::make($request->all(), [
                'nombre' => 'unique:turnos'
            ]);
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $nombre . ' ya existe',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $turno = new Turnos;
                $turno->nombre = $nombre;
                $turno->estado = '0';
                $turno->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function GestionCreate(Request $request)
    {

        try {
            $inicio = $request->input('inicio');
            $fin = $request->input('fin');
            $estado = Gestiones::where('estado', '0')->value('nombre');
            $date_inicio = Gestiones::where([
                ['fecha_inicial', '<=', $inicio],
                ['fecha_final', '>=', $inicio],
            ])->value('fecha_final');
            $date_fin = Gestiones::where(([
                ['fecha_inicial', '<=', $fin],
                ['fecha_final', '>=', $fin],
            ]))->value('fecha_inicial');
            $date_entre = Gestiones::where(([
                ['fecha_inicial', '>', $inicio],
                ['fecha_final', '<', $fin],
            ]))->count();
            $validator = Validator::make($request->all(), [
                'fin' => 'after:inicio'
            ]);
            if ($date_inicio > 0) {
                if ($date_fin > 0) {
                    $notificacion = array(
                        'message' => 'La fecha de inicio y fin estan en un rango existente',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    $notificacion = array(
                        'message' => 'La fecha de inicio esta en un rango existente',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                }
            } else {
                if ($date_fin > 0) {
                    $notificacion = array(
                        'message' => 'La fecha de fin esta en un rango existente',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    if ($date_entre > 0) {
                        $notificacion = array(
                            'message' => 'Existen gestiones dentro del rango de fechas',
                            'alert-type' => 'error'
                        );
                        return back()->with($notificacion)
                            ->with('error_code', 1)
                            ->withInput();
                    } else {
                        if ($validator->fails()) {
                            $notificacion = array(
                                'message' => 'La fecha de inicio debe ser menor a la fecha final',
                                'alert-type' => 'error'
                            );
                            return back()->with($notificacion)
                                ->with('error_code', 1)
                                ->withInput();
                        } else {
                            if ($estado == true) {
                                $notificacion = array(
                                    'message' => 'No se puede guardar ya que existe una Gestion Abierta',
                                    'alert-type' => 'error'
                                );
                                return back()->with($notificacion)
                                    ->with('error_code', 1)
                                    ->withInput();
                            } else {
                                $gestion = new Gestiones;
                                $gestion->nombre = $request->input('nombre');
                                $gestion->fecha_inicial = $request->input('inicio');
                                $gestion->fecha_final = $request->input('fin');
                                $gestion->descripcion = $request->input('descripcion');
                                $gestion->estado = '0';
                                $gestion->save();
                                return back();
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }
    }

    public function TcalificacionCreate(Request $request)
    {

        try {
            $inicio = $request->input('inicio');
            $fin = $request->input('fin');
            $nombre = $request->input('nombre');
            $date_inicio = TipoCalificaciones::where(([
                ['fecha_inicial', '<=', $inicio],
                ['fecha_final', '>=', $inicio],
            ]))->value('fecha_final');
            $date_fin = TipoCalificaciones::where(([
                ['fecha_inicial', '<=', $fin],
                ['fecha_final', '>=', $fin],
            ]))->value('fecha_inicial');
            $date_entre = TipoCalificaciones::where(([
                ['fecha_inicial', '>', $inicio],
                ['fecha_final', '<', $fin],
            ]))->count();
            $validator = Validator::make($request->all(), [
                'fin' => 'after:inicio',
                'nombre' => 'unique:tipo_calificaciones'
            ], [
                'fin.after' => 'La fecha de inicio debe ir antes que la fecha final.',
                'nombre.unique' => 'El nombre ya a existe.'
            ]);
            $error = $validator->errors();
            if ($date_inicio > 0) {
                if ($date_fin > 0) {
                    $notificacion = array(
                        'message' => 'Las fechas de inicio y finalizacion estan en un rango existente',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    $notificacion = array(
                        'message' => 'La fecha de inicio esta en un rango existente',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                }
            } else {
                if ($date_fin > 0) {
                    $notificacion = array(
                        'message' => 'La fecha de fin esta en un rango existente',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    if ($date_entre > 0) {
                        $notificacion = array(
                            'message' => 'Existen datos dentro del rango de fechas',
                            'alert-type' => 'error'
                        );
                        return back()->with($notificacion)
                            ->with('error_code', 1)
                            ->withInput();
                    } else {
                        if ($validator->fails()) {
                            $notificacion = array(
                                'message' => $error->first('fin') . ' ' . $error->first('nombre'),
                                'alert-type' => 'error'
                            );
                            return back()->with($notificacion)
                                ->with('error_code', 1)
                                ->withInput();
                        } else {
                            $tipo = new TipoCalificaciones;
                            $tipo->nombre = $nombre;
                            $tipo->fecha_inicial = $inicio;
                            $tipo->fecha_final = $fin;
                            $tipo->estado = '0';
                            $tipo->save();
                            return back();
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function MateriaCreate(Request $request)
    {

        try {
            $idarea = $request->input('area_id');
            $nombre = $request->input('nombre');
            $validar = Validator::make($request->all(), [
                'nombre' => [
                    'required', Rule::unique('materias', 'nombre')->where(function ($query) use ($idarea) {
                        $query->where('id_area', $idarea);
                    })]
            ]);
            if ($validar->fails()) {
                $area = Areas::where('id', $idarea)->value('nombre');
                $notificacion = array(
                    'message' => 'Ya existe ' . $nombre . ' en ' . $area,
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {

                $materia = new Materias;
                $materia->nombre = $nombre;
                $materia->id_area = $idarea;
                $materia->estado = '0';
                $materia->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function TutorCreate(Request $request)
    {

        try {
            $validar = Validator::make($request->all(), [
                'ci' => 'unique:personas'
            ]);
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => 'Este CI ya existe',
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $cis = $request->input('ci');
                $persona = new Personas;
                $persona->nombre = $request->input('nombre');
                $persona->apellidopat = $request->input('apaterno');
                $persona->apellidomat = $request->input('amaterno');
                $persona->direccion = $request->input('direccion');
                $persona->ci = $cis;
                $persona->telefono = $request->input('telefono');
                $persona->sexo = $request->input('sexo');
                $persona->save();
                $id = Personas::where('ci', $cis)->value('id');
                $tutor = new Tutores;
                $tutor->id_persona = $id;
                $tutor->save();
                $caracter = substr($cis, 0, 4);
                $user = new User();
                $user->username = $cis;
                $user->password = Hash::make($caracter);
                $user->id_persona = $id;
                $user->save();
                $rol = new PersonaRoles();
                $rol->id_persona = $id;
                $rol->id_rol = 5;
                $rol->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function AlumnoCreate(Request $request)
    {

        try {
            $validar = Validator::make($request->all(), [
                'ci' => 'unique:personas',
                'rude' => 'unique:alumnos'
            ]);
            $error = $validar->errors();
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $error->first('rude') . ' ' . $error->first('ci'),
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $persona = new Personas;
                $persona->nombre = $request->input('nombre');
                $persona->apellidopat = $request->input('apaterno');
                $persona->apellidomat = $request->input('amaterno');
                $persona->direccion = $request->input('direccion');
                $persona->ci = $request->input('ci');
                $persona->telefono = $request->input('telefono');
                $persona->sexo = $request->input('sexo');
                $persona->save();
                $cis = $request->input('ci');
                $id = Personas::where('ci', $cis)->value('id');
                $alumno = new Alumnos;
                $alumno->nacimiento = $request->input('nacimiento');
                $alumno->id_persona = $id;
                $alumno->idtutor = $request->input('tutor_id');
                $alumno->rude = $request->input('rude');
                $alumno->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function ProfesorCreate(Request $request)
    {

        try {
            $validar = Validator::make($request->all(), [
                'ci' => 'unique:personas'
            ]);
            $error = $validar->errors();
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $error->first('rude') . ' ' . $error->first('ci'),
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $persona = new Personas;
                $persona->nombre = $request->input('nombre');
                $persona->apellidopat = $request->input('apaterno');
                $persona->apellidomat = $request->input('amaterno');
                $persona->direccion = $request->input('direccion');
                $persona->ci = $request->input('ci');
                $persona->telefono = $request->input('telefono');
                $persona->sexo = $request->input('sexo');
                $persona->save();
                $cis = $request->input('ci');
                $id = Personas::where('ci', $cis)->value('id');
                $profesor = new Profesores();
                $profesor->id_persona = $id;
                $profesor->save();
                $caracter = substr($cis, 0, 4);
                $user = new User();
                $user->username = $cis;
                $user->password = Hash::make($caracter);
                $user->id_persona = $id;
                $user->save();
                $rol = new PersonaRoles();
                $rol->id_persona = $id;
                $rol->id_rol = 4;
                $rol->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function CursosCreate(Request $request)
    {

        try {
            $idnivel = $request->input('nivel');
            $nombre = $request->input('nombre');
            $validar = Validator::make($request->all(), [
                'nombre' => [
                    'required', Rule::unique('cursos', 'nombre')->where(function ($query) use ($idnivel) {
                        $query->where('id_nivel', $idnivel);
                    })]
            ]);
            if ($validar->fails()) {
                $nivel = Niveles::where('id', $idnivel)->value('nombre');
                $notificacion = array(
                    'message' => 'Ya existe ' . $nombre . ' en ' . $nivel,
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $curso = new Cursos();
                $curso->nombre = $nombre;
                $curso->grado = $request->input('grado');
                $curso->id_nivel = $idnivel;
                $curso->estado = '0';
                $curso->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }
    }

    public function ParalelosCreate(Request $request)
    {

        try {
            $idgestion = $request->input('gestion_id');
            $idturno = $request->input('turno_id');
            $idcurso = $request->input('curso_id');
            $nombre = $request->input('nombre');
            $cupo = $request->input('cupo');
            $validar = Validator::make($request->all(), [
                'nombre' => [
                    'required', Rule::unique('curso_paralelos', 'nombre')->where(function ($query) use ($idgestion, $idturno, $idcurso) {
                        $query->where([['id_gestion', $idgestion], ['id_turno', $idturno], ['id_curso', $idcurso]]);
                    })]
            ]);
            if ($validar->fails()) {
                $gestion = Gestiones::where('id', $idgestion)->value('nombre');
                $turno = Turnos::where('id', $idturno)->value('nombre');
                $curso = Cursos::where('id', $idcurso)->value('nombre');
                $notificacion = array(
                    'message' => 'Ya existe el paralelo ' . $nombre . ' en la ' . $gestion . ' en turno ' . $turno . ' y el curso ' . $curso,
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $paralelo = new CursoParalelos();
                $paralelo->id_gestion = $idgestion;
                $paralelo->id_turno = $idturno;
                $paralelo->id_curso = $idcurso;
                $paralelo->nombre = $nombre;
                $paralelo->cupo_maximo = $cupo;
                $paralelo->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }
    }

    public function InscripcionCreate(Request $request)
    {

        try {
            $idcurso = $request->input('curso_id');
            $idalumno = $request->input('alumno_id');
            $alumno = $request->input('alumno_name');
            $curso = $request->input('curso_name');
            $restan = Inscripciones::where('id_cursos_paralelos', '=', $idcurso)->count();
            $tnotas = TipoCalificaciones::all();
            $materias = AsignarMaterias::where('id_cursos_paralelos', '=', $idcurso)->get();
            $cupos = CursoParalelos::where('id', '=', $idcurso)->value('cupo_maximo');
            $validar = Validator::make($request->all(), [
                'alumno_id' => [
                    'required', Rule::unique('inscripciones', 'id_alumno')->where(function ($query) use ($idcurso) {
                        $query->where('id_cursos_paralelos', $idcurso);
                    })]
            ]);
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $alumno . ' ya fue inscrito en ' . $curso,
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                if ($restan == $cupos) {
                    $notificacion = array(
                        'message' => 'Los Cupos estan llenos',
                        'alert-type' => 'error'
                    );
                    return back()->with($notificacion)
                        ->with('error_code', 1)
                        ->withInput();
                } else {
                    $inscripcion = new Inscripciones();
                    $inscripcion->fecha = date("Ymd");
                    $inscripcion->observacion = $request->input('observacion');
                    $inscripcion->id_cursos_paralelos = $idcurso;
                    $inscripcion->id_alumno = $idalumno;
                    $inscripcion->save();
                    $id_inscripcion = Inscripciones::where([['id_alumno', '=', $idalumno], ['id_cursos_paralelos', '=', $idcurso]])->value('id');
                    foreach ($tnotas as $tnota) {
                        foreach ($materias as $materia) {
                            $calificacion = new Calificaciones();
                            $calificacion->id_inscripcion = $id_inscripcion;
                            $calificacion->id_asignar_materia = $materia->id;
                            $calificacion->id_tipo_calificaciones = $tnota->id;
                            $calificacion->nota = 0;
                            $calificacion->save();
                        }
                    }
                    return back();
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function materiaCursosCreate(Request $request)
    {

        try {
            $cursos = $request->input('curso_id');
            $total = count($request->input('materias'));
            $asignaciones = CursoParalelos::where('id_curso', '=', $cursos)->get();
            for ($i = 0; $i < $total; $i++) {
                $materiaCurso = new MateriaCursos();
                $materiaCurso->id_materia = $request->input('materias.' . $i);
                $materiaCurso->id_curso = $cursos;
                $materiaCurso->save();
                foreach ($asignaciones as $asignacion) {
                    $asignar = new AsignarMaterias();
                    $asignar->fecha_asignacion = date("Ymd");
                    $asignar->id_materia = $request->input('materias.' . $i);
                    $asignar->id_cursos_paralelos = $asignacion->id;
                    $asignar->save();
                }
            }
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }

    }

    public function asignarMateriaCreate(Request $request)
    {

        try {
            $idParalelo = Session('paralelo-id');
            $idMateria = $request->input('materia_id');
            $idProfesor = $request->input('profesor_id');
            $materia = Materias::where('id', $idMateria)->value('nombre');
            $profesor = $request->input('profesor_name');
            $validar = Validator::make($request->all(), [
                'profesor_id' => [
                    'required', Rule::unique('asignar_materias', 'id_profesores')->where(function ($query) use ($idMateria, $idParalelo) {
                        $query->where([['id_materia', $idMateria], ['id_cursos_paralelos', $idParalelo]]);
                    })]
            ]);
            if ($validar->fails()) {
                $notificacion = array(
                    'message' => $materia . ' ya fue asignada a ' . $profesor,
                    'alert-type' => 'error'
                );
                return back()->with($notificacion)
                    ->with('error_code', 1)
                    ->withInput();
            } else {
                $asignar = new AsignarMaterias();
                $asignar->fecha_asignacion = date("Ymd");
                $asignar->id_materia = $idMateria;
                $asignar->id_profesores = $idProfesor;
                $asignar->id_cursos_paralelos = $idParalelo;
                $asignar->save();
                return back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            $notificacion = array(
                'message' => 'Ocurrio un error, vuelva a ingresar los datos.',
                'alert-type' => 'error'
            );
            return back()->with($notificacion)
                ->with('error_code', 1)
                ->withInput();
        }
    }

}
