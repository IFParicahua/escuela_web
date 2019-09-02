<?php

namespace App\Http\Controllers;

use App\Cuotas;
use App\CursoParalelos;
use App\Cursos;
use App\Inscripciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContadorController extends Controller
{
    public function index()
    {
        return view('Contador');
    }

    public function monto(Request $request)
    {
        $monto = $request->input('monto');
        session()->put('monto-cobrar', $monto);
        return redirect('Contador/inicio');
    }

    public function inicio()
    {
        $niveles = Cursos::select('id_nivel')->groupBy('id_nivel')->get();
        $cursos = Inscripciones::select('id_cursos_paralelos')->groupBy('id_cursos_paralelos')->get();
        return view('ContadorInicio', compact('cursos', 'niveles'));
    }

    public function contadorAlumno(Request $request)
    {
        if ($request->get('id')) {
            $idParalelos = $request->get('id');
            $curso = CursoParalelos::where('id', '=', $idParalelos)->first();
            $inscripciones = Inscripciones::where('id_cursos_paralelos', '=', $idParalelos)->get();
            $cuotas = Cuotas::all();

            $tabla = '<div class="col-11" style="margin: auto;"><div class="row"><div class="col-md-12 bg-primary">';
            $tabla .= '<h3 style="text-align: center;color:#ffffff">' . $curso->paraleloCurso->nombre . ' ' . $curso->nombre . ' de nivel ' . $curso->paraleloCurso->cursoNivel->nombre . '</h3>';

            $tabla .= '</div></div>';

            $tabla .= '<div class="row"><table class="table table-scroll table-striped" style="background:#ffffff;" id="data_table"><thead class="bg-primary" style="color:#ffffff">';
            $tabla .= '<tr><th scope="col" style="width: 200px;">Alumnos</th><th scope="col">Febrero</th><th scope="col">Marzo</th><th scope="col">Abril</th><th scope="col">Mayo</th><th scope="col">Junio</th><th scope="col">Julio</th><th scope="col">Agosto</th><th scope="col">Septiempre</th><th scope="col">Octubre</th><th scope="col">Noviembre</th></tr></thead><tbody style="background-color: #ffffff">';
            foreach ($inscripciones as $inscripcion) {
                $tabla .= '<tr>';
                $tabla .= '<td style="width: 200px;font-size: 14px">' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidopat . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->apellidomat . ' ' . $inscripcion->inscripcionAlumno->alumnoPersona->nombre . '</td>';
                foreach ($cuotas as $cuota) {
                    if ($cuota->id_inscripcion == $inscripcion->id) {
                        $tabla .= '<td style="font-size: 14px">';
                        $tabla .= ' ' . $cuota->estado . ' ';
                        if ($cuota->fecha_pago != null) {
                            $tabla .= date('d/m/Y', strtotime($cuota->fecha_pago));
                        }
                        $tabla .= '</td>';
                        $tabla .= '<td><a style="color: #007bff;width: 30px;height: 28px;padding: 4px;" class="icon-pencil " id="edit-item" title="Editar" data-id="' . $cuota->id . '" data-estado="' . $cuota->estado . '" data-fecha="' . $cuota->fecha_pago . '"></a></td>';
                    }
                }
                $tabla .= '</tr>';
            }
            $tabla .= '</div>';
            echo $tabla;
        }
    }

    public function cuotaEditar(Request $request)
    {
        setlocale(LC_TIME, 'spanish');
        if ($request->get('id')) {
            try {
                $id = $request->get('id');
                $estado = $request->get('estado');
                $fecha = $request->get('fecha');
                if ($fecha > 0) {
                    $numero = date('m', strtotime($fecha));
                    $numero = (string)(int)$numero;
                } else {
                    $numero = 0;
                }

                $monto = Session('monto-cobrar');
                $meses = array(NULL, "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                $descripcion = $meses[$numero];
                $cuota = Cuotas::find($id);
                $cuota->numero_mes = $numero;
                $cuota->monto = $monto;
                $cuota->estado = $estado;
                $cuota->fecha_pago = $fecha;
                $cuota->descripcion_cuo = $descripcion;
                $cuota->save();
                $nota = 'bien';
                echo $nota;
            } catch (\Exception $e) {
                DB::rollBack();
                echo "fallo";
            }
        }
    }
}

