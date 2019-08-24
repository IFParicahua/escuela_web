<?php

namespace App\Http\Controllers;

use App\AsignarMaterias;
use App\Calificaciones;
use App\CursoParalelos;
use App\Inscripciones;
use App\Profesores;
use App\TipoCalificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfesorController extends Controller
{
    public function index()
    {
        $id = Profesores::where('id_persona', '=', Auth::user()->id_persona)->value('id');
        $cursos = AsignarMaterias::where('id_profesores', '=', $id)->select('id_cursos_paralelos')->groupBy('id_cursos_paralelos')->get();
        return view('Profesor', compact('cursos'));
    }

    public function profesorCurso(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $cursos = CursoParalelos::where('id', '=', $query)->get();
            $fecha = date("Ymd");
            $bimestre = TipoCalificaciones::where([
                ['fecha_inicial', '<=', $fecha],
                ['fecha_final', '>=', $fecha],
            ])->value('nombre');
            $idBimestre = TipoCalificaciones::where([
                ['fecha_inicial', '<=', $fecha],
                ['fecha_final', '>=', $fecha],
            ])->value('id');
            $inscripciones = Inscripciones::with('calificaciones')->where('id_cursos_paralelos', '=', $query)->get();
            $tabla = '<div class="col-11" style="margin: auto;"><div class="row"><div class="col-md-12 bg-primary">';
            foreach ($cursos as $curso) {
                $tabla .= '<h3 style="text-align: center;color:#ffffff">' . $curso->paraleloCurso->nombre . ' ' . $curso->nombre . ' de ' . $curso->paraleloCurso->cursoNivel->nombre . '</h3>';
            }
            $tabla .= '</div></div>';
            $tabla .= '<div class="row"><table class="table table-scroll table-striped" style="background:#ffffff;"><thead class="bg-primary" style="color:#ffffff">';
            $tabla .= '<tr><th scope="col">Alumno</th><th scope="col">' . $bimestre . '</th><th scope="col"></th></tr></thead><tbody>';
            foreach ($inscripciones as $inscripcion) {
                $tabla .= '<tr>';
                $tabla .= '<td>' . $inscripcion->inscripcionAlumno->alumnoPersona->nombre . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidopat . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidomat . '</td>';
                if ($inscripcion->calificaciones[$idBimestre - 1]->nota == 0) {
                    $tabla .= '<td>-</td><td style="text-align: center"><a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-plus "id="edit-item" title="Editar"data-id=' . $inscripcion->calificaciones[$idBimestre - 1]->id . '></a></td>';
                } else {
                    $tabla .= '<td>' . $inscripcion->calificaciones[$idBimestre - 1]->nota . '</td><td style="text-align: center"><a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-plus "id="edit-item" title="Editar" data-id=' . $inscripcion->calificaciones[$idBimestre - 1]->id . ' data-nota=' . $inscripcion->calificaciones[$idBimestre - 1]->nota . '></a></td>';
                }
                $tabla .= '</tr>';
            }
            $tabla .= '</tbody></table></div></div>';
            echo $tabla;
        }
    }

    public function notaEditar(Request $request)
    {
        $id = $request->input('pknota');
        $notas = Calificaciones::find($id);
        $notas->nota = $request->input('editar_nota');
        $notas->save();
        return back();
    }
}
