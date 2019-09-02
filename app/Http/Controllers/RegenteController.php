<?php

namespace App\Http\Controllers;

use App\CursoParalelos;
use App\Cursos;
use App\Inscripciones;
use Illuminate\Http\Request;

class RegenteController extends Controller
{
    public function index()
    {
        $niveles = Cursos::select('id_nivel')->groupBy('id_nivel')->get();
        $cursos = Inscripciones::select('id_cursos_paralelos')->groupBy('id_cursos_paralelos')->get();
        return view('Regente', compact('cursos', 'niveles'));
    }


    public function regenteAlumno(Request $request)
    {
        if ($request->get('id')) {
            $idParalelos = $request->get('id');
            $fechaActual = date("d/m/Y");
            $curso = CursoParalelos::where('id', '=', $idParalelos)->first();
            $inscripciones = Inscripciones::where('id_cursos_paralelos', '=', $idParalelos)->get();
            $i = 0;
            $tabla = '<div class="col-11" style="margin: auto;"><div class="row"><div class="col-md-12 bg-primary">';
            $tabla .= '<h3 style="text-align: center;color:#ffffff">' . $curso->paraleloCurso->nombre . ' ' . $curso->nombre . ' de nivel ' . $curso->paraleloCurso->cursoNivel->nombre . '</h3>';
            $tabla .= '</div></div>';
            $tabla .= '<div class="row"><table class="table table-scroll table-striped" style="background:#ffffff;" id="data_table"><thead class="bg-primary" style="color:#ffffff">';
            $tabla .= '<tr><th scope="col" style="width: 400px;">Alumnos</th><th scope="col">' . $fechaActual . '</th></tr></thead><tbody style="background-color: #ffffff">';
            foreach ($inscripciones as $inscripcion) {
                $i++;
                $tabla .= '<tr>';
                $tabla .= '<td style="width: 400px;font-size: 14px">' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidopat . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidomat . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->nombre . '</td>';
                $tabla .= '<td>';
                $tabla .= '<div class="custom-control custom-radio custom-control-inline"><input type="radio" id="Radios1' . $i . '" name="Radios' . $i . '" class="custom-control-input" value="Falta"><label class="custom-control-label" for="Radios1' . $i . '">Falta</label></div>';
                $tabla .= '<div class="custom-control custom-radio custom-control-inline"><input type="radio" id="Radios2' . $i . '" name="Radios' . $i . '" class="custom-control-input" value="Asistencia"><label class="custom-control-label" for="Radios2' . $i . '">Asistencia</label></div>';
                $tabla .= '<div class="custom-control custom-radio custom-control-inline"><input type="radio" id="Radios3' . $i . '" name="Radios' . $i . '" class="custom-control-input" value="Licencia"><label class="custom-control-label" for="Radios3' . $i . '">Licencia</label></div>';
                $tabla .= '</td></tr>';
            }
            $tabla .= '</div>';
            echo $tabla;
        }
    }

}
