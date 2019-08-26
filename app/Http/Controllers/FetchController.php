<?php

namespace App\Http\Controllers;


use App\CursoParalelos;
use App\Cursos;
use App\Gestiones;
use App\MateriaCursos;
use App\Turnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FetchController extends Controller
{
    public function tutorcomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('personas')
                ->join('tutores', 'personas.id', '=', 'tutores.id_persona')
                ->where([['ci', 'like', "%{$query}%"]])
                ->orWhere([['nombre', 'like', "%{$query}%"]])
                ->orWhere([['apellidopat', 'like', "%{$query}%"]])
                ->orWhere([['apellidomat', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 caja" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->ci . ' - ' . $row->nombre . ' ' . $row->apellidopat . ' ' . $row->apellidomat . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function areasearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $areas = DB::table('areas')->where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($areas as $area) {
                $output .= '<option value="' . $area->id . '">' . $area->nombre . '</option>';
            }
            echo $output;
        }
    }

    public function nivelsearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $niveles = DB::table('niveles')->where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($niveles as $nivel) {
                $output .= '<option value="' . $nivel->id . '">' . $nivel->nombre . '</option>';
            }
            echo $output;
        }
    }

    public function turnosearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $turnos = Turnos::where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($turnos as $turno) {
                $output .= '<option value="' . $turno->id . '">' . $turno->nombre . '</option>';
            }
            echo $output;
        }
    }

    public function cursosearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $cursos = Cursos::where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($cursos as $curso) {
                $output .= '<option value="' . $curso->id . '">' . $curso->nombre . ' de nivel ' . $curso->cursoNivel->nombre . '</option>';
            }
            echo $output;
        }
    }

    public function gestionsearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $gestiones = Gestiones::where('id', '!=', $query)->get();
            $output = ' ';
            foreach ($gestiones as $gestion) {
                $output .= '<option value="' . $gestion->id . '">' . $gestion->nombre . '</option>';
            }
            echo $output;
        }
    }

    public function alumnosearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('personas')
                ->join('alumnos', 'personas.id', '=', 'alumnos.id_persona')
                ->where([['ci', 'like', "%{$query}%"]])
                ->orWhere([['nombre', 'like', "%{$query}%"]])
                ->orWhere([['apellidopat', 'like', "%{$query}%"]])
                ->orWhere([['apellidomat', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 alumno" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->ci . ' - ' . $row->nombre . ' ' . $row->apellidopat . ' ' . $row->apellidomat . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function paralelocomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('curso_paralelos')
                ->join('turnos', 'turnos.id', '=', 'curso_paralelos.id_turno')
                ->join('cursos', 'cursos.id', '=', 'curso_paralelos.id_curso')
                ->join('niveles', 'niveles.id', '=', 'cursos.id_nivel')
                ->select(
                    'curso_paralelos.id as id',
                    'curso_paralelos.nombre as paralelo',
                    'turnos.nombre as turno',
                    'cursos.nombre as curso',
                    'niveles.nombre as nivel'
                )
                ->where([['curso_paralelos.nombre', 'like', "%{$query}%"]])
                ->orWhere([['cursos.nombre', 'like', "%{$query}%"]])
                ->orWhere([['turnos.nombre', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 paralelo" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->curso . ' ' . $row->paralelo . ' de nivel ' . $row->nivel . ' turno ' . $row->turno . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function materiacomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('materias')
                ->join('areas', 'areas.id', '=', 'materias.id_area')
                ->select(
                    'materias.id as id',
                    'materias.nombre as materias',
                    'areas.nombre as areas'
                )
                ->where([['materias.nombre', 'like', "%{$query}%"]])
                ->orWhere([['areas.nombre', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 materia" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->areas . ' - ' . $row->materias . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function cursocomplete(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('cursos')
                ->join('niveles', 'niveles.id', '=', 'cursos.id_nivel')
                ->select(
                    'cursos.id as id',
                    'cursos.nombre as cursos',
                    'niveles.nombre as niveles'
                )
                ->where([['cursos.estado', '=', '0'], ['cursos.nombre', 'like', "%{$query}%"]])
                ->orWhere([['cursos.estado', '=', '0'], ['niveles.nombre', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 curso" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->cursos . ' de nivel ' . $row->niveles . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function cursosRestantes(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $areas = $results = DB::select('SELECT DISTINCT materias.id_area, (areas.nombre) as nombre  FROM materias INNER JOIN areas ON areas.id = materias.id_area where materias.id NOT IN (SELECT materia_cursos.id_materia FROM materia_cursos WHERE materia_cursos.id_curso =?);', [$query]);
            $materias = $results = DB::select('SELECT * FROM materias where materias.id NOT IN (SELECT materia_cursos.id_materia FROM materia_cursos WHERE materia_cursos.id_curso =?);', [$query]);
            $content = ' ';
            foreach ($areas as $area) {
                $content .= '<div id="grado" class="form-group col-md-3 pl-1">';
                $content .= '<p>' . $area->nombre . '</p>';
                foreach ($materias as $materia) {
                    if ($materia->id_area == $area->id_area) {
                        $content .= '<input type="checkbox" id="materias[]" name="materias[]" value="' . $materia->id . '">' . $materia->nombre . '<br>';
                    }
                }
                $content .= '</div>';
            }
            $content .= ' ';
            echo $content;
        }
    }

    public function profesorsearch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('personas')
                ->join('profesores', 'personas.id', '=', 'profesores.id_persona')
                ->where([['ci', 'like', "%{$query}%"]])
                ->orWhere([['nombre', 'like', "%{$query}%"]])
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '<li class="pl-1 profesor" id="' . $row->id . '"><a href="#" style="color: #1b1e21">' . $row->ci . ' - ' . $row->nombre . ' ' . $row->apellidopat . ' ' . $row->apellidomat . '</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function materiafilter(Request $request)
    {
        if ($request->get('query')) {
            $id = Session('paralelo-id');
            $query = $request->get('query');
            $idCurso = CursoParalelos::where('id', '=', $id)->value('id_curso');
            $materias = MateriaCursos::where([['materia_cursos.id_curso', '=', $idCurso], ['materia_cursos.id_materia', '!=', $query]])->get();
            $output = ' ';
            foreach ($materias as $materia) {
                $output .= '<option value="' . $materia->materiaMateria->id . '">' . $materia->materiaMateria->nombre . '</option>';
            }
            echo $output;
        }
    }

}
