<?php

namespace App\Http\Controllers;

use App\Alumnos;
use App\Calificaciones;
use App\Comportamientos;
use App\Inscripciones;
use App\TipoCalificaciones;
use App\Tutores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TutorController extends Controller
{
    public function index()
    {
        $idTutor = Tutores::where('id_persona', '=', Auth::user()->id_persona)->value('id');
        $hijos = Alumnos::where('idtutor', '=', $idTutor)->get();
        return view('Padre', compact('hijos'));
    }

    public function tutoAlumno(Request $request)
    {
        if ($request->get('id')) {
            $idAlumno = $request->get('id');
            $inscripcion = Inscripciones::where('id_alumno', '=', $idAlumno)->value('id');
            $materias = Calificaciones::where('id_inscripcion', '=', $inscripcion)->select('id_asignar_materia')->groupBy('id_asignar_materia')->get();
            $notas = Calificaciones::where('id_inscripcion', '=', $inscripcion)->get();
            $bimenstres = TipoCalificaciones::all();
            $tabla = '<div class="col-11" style="margin: auto;">';
            $tabla .= '<div class="row"><table class="table table-scroll table-striped" style="background:#ffffff;" id="data_table"><thead class="bg-primary" style="color:#ffffff">';
            $tabla .= '<tr><th scope="col">Materias</th>';
            foreach ($bimenstres as $bimenstre) {
                $tabla .= '<th scope="col">' . $bimenstre->nombre . '</th>';
            }
            $tabla .= '</tr></thead><tbody style="background-color: #ffffff">';
            foreach ($materias as $materia) {
                $tabla .= '<tr>';
                $tabla .= '<td>' . $materia->calificacionMateria->asignarMateria->nombre . '</td>';
                foreach ($notas as $nota) {
                    if ($nota->id_asignar_materia == $materia->id_asignar_materia) {
                        if ($nota->nota > 0) {
                            $tabla .= '<td style="text-align: center;padding-left: 0px;padding-right: 50px;">' . $nota->nota . '</td>';
                        } else {
                            $tabla .= '<td style="text-align: center;padding-left: 0px;padding-right: 50px;">-</td>';
                        }
                    }
                }
                $tabla .= '</tr>';
            }
            echo $tabla;
        }
    }

    public function alumnoComportamiento(Request $request)
    {
        if ($request->get('id')) {
            $idAlumno = $request->get('id');
            $inscripcion = Inscripciones::where('id_alumno', '=', $idAlumno)->value('id');
            $comportamientos = Comportamientos::where('id_inscripcion', '=', $inscripcion)->get();
            $tabla = '<div class="col-11" style="margin: auto;"><div class="row">';
            foreach ($comportamientos as $comportamiento) {
                $tabla .= '<div class="col-sm-6"><div class="card bg-light" style="margin-bottom: 10px;"><label style="position: absolute; right: 10px">' . date("d/m/Y", strtotime($comportamiento->fecha_comp)) . '</label><div class="card-body"><h5 class="card-title">' . $comportamiento->compMateria->asignarMateria->nombre . '</h5>';
                $tabla .= '<p class="card-text">' . $comportamiento->descripcion . '</p></div></div></div>';
            }
            $tabla .= '</div></div>';
            echo $tabla;
        }
    }
}
