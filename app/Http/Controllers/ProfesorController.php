<?php

namespace App\Http\Controllers;

use App\AsignarMaterias;
use App\Calificaciones;
use App\Materias;
use App\Profesores;
use App\TipoCalificaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    public function index()
    {
        $id = Profesores::where('id_persona', '=', Auth::user()->id_persona)->value('id');
        $cursos = AsignarMaterias::where('id_profesores', '=', $id)->select('id_cursos_paralelos')->groupBy('id_cursos_paralelos')->get();
        $materias = AsignarMaterias::where('id_profesores', '=', $id)->get();
        return view('Profesor', compact('cursos', 'materias'));
    }

    public function prueva(Request $request)
    {
        if ($request->get('profesor')) {
            $profesor = $request->get('profesor');
            $curso = $request->get('curso');
            $materia = $request->get('materia');
            $query = 'Profesor = ' . $profesor . ' Curso = ' . $curso . ' Materia = ' . $materia;
            echo $query;
        }
    }

    public function profesorCurso(Request $request)
    {
        if ($request->get('id')) {

            $idAsgMateria = $request->get('id');
            $idMateria = $request->get('materia');
            $materia = Materias::where('id', '=', $idMateria)->value('nombre');
            $bimestre = TipoCalificaciones::where('estado', '=', 0)->value('nombre');
            $idBimestre = TipoCalificaciones::where('estado', '=', 0)->value('id');
            $notas = Calificaciones::where([['id_asignar_materia', '=', $idAsgMateria], ['id_tipo_calificaciones', '=', $idBimestre]])->get();
            $tabla = '<div class="col-11" style="margin: auto;"><div class="row"><div class="col-md-12 bg-primary">';
            $tabla .= '<h3 style="text-align: center;color:#ffffff">' . $materia . '</h3>';

            $tabla .= '</div></div>';
            $tabla .= '<div class="row"><table class="table table-scroll table-striped" style="background:#ffffff;" id="data_table"><thead class="bg-primary" style="color:#ffffff">';
            $tabla .= '<tr><th scope="col">Alumnos</th><th scope="col">' . $bimestre . '</th><th scope="col"></th></tr></thead><tbody style="background-color: #ffffff">';
            foreach ($notas as $nota) {
                if ($nota->calificacionMateria->asignarParalelo->paraleloGestion->estado == 0) {
                    $tabla .= '<tr>';
                    $tabla .= '<td>' . $nota->calificacionInscripcion->inscripcionAlumno->alumnoPersona->apellidopat . ' ' . $nota->calificacionInscripcion->inscripcionAlumno->alumnoPersona->apellidomat . ' ' . $nota->calificacionInscripcion->inscripcionAlumno->alumnoPersona->nombre . '</td>';
                    $tabla .= '<td>';
                    if ($nota->nota == 0) {
                        $tabla .= '-';
                    } else {
                        $tabla .= $nota->nota;
                    }
                    $tabla .= '</td>';
                    $tabla .= '<td style="text-align: center"><a style="color: rgb(255,255,255)" class="btn btn-success btn-fill icon-plus "id="edit-item" title="Editar" data-id=' . $nota->id . ' data-nota=' . $nota->nota . '></a></td>';
                    $tabla .= '</tr>';
                }
            }
            echo $tabla;
        }
    }
    public function notaEditar(Request $request)
    {
        if ($request->get('id')) {
            try {
                $id = $request->get('id');
                $nota = $request->get('nota');
                $notas = Calificaciones::find($id);
                $notas->nota = $nota;
                $notas->save();
                echo $nota;
            } catch (\Exception $e) {
                DB::rollBack();
                echo "fallo";
            }

        }
    }
}
