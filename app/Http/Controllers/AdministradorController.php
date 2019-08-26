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
use App\Profesores;
use App\TipoCalificaciones;
use App\Turnos;
use App\Tutores;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class AdministradorController extends Controller
{
    //VISTAS
    public function index()
    {
        return view('Administrador');
    }

    public function area()
    {
        $areas = Areas::all();
        return view('AdminAreas', ['areas' => $areas]);
    }

    public function nivel()
    {
        $niveles = Niveles::all();
        return view('AdminNiveles', ['niveles' => $niveles]);
    }

    public function turno()
    {
        $turnos = Turnos::all();
        return view('AdminTurnos', ['turnos' => $turnos]);
    }

    public function gestion()
    {
        $gestiones = Gestiones::all();
        return view('AdminGestiones', ['gestiones' => $gestiones]);
    }

    public function tipocalificacion()
    {
        $TCalificaciones = TipoCalificaciones::all();
        return view('AdminTipoCalificaciones', ['TCalificaciones' => $TCalificaciones]);
    }

    public function materia()
    {
        $areas = Areas::all();
        $materias = Materias::with('materiasAreas')->get();
        return view('AdminMaterias', compact('areas', 'materias'));
    }

    public function tutor()
    {
        $tutores = Tutores::with('tutorPersona')->get();
        return view('AdminTutores', compact('tutores'));
    }

    public function alumno()
    {
        $alumnos = Alumnos::with('alumnoPersona')->get();
        return view('AdminAlumnos', compact('alumnos', 'tutores'));
    }

    public function profesor()
    {
        $profesores = Profesores::with('profesorPersona')->get();
        return view('AdminProfesores', compact('profesores'));
    }

    public function curso()
    {
        $cursos = Cursos::with('cursoNivel')->get();
        $niveles = Niveles::all();
        return view('AdminCursos', compact('cursos', 'niveles'));
    }

    public function paralelo()
    {
        $paralelos = CursoParalelos::all();
        $turnos = Turnos::all();
        $cursos = Cursos::all();
        $gestiones = Gestiones::all();
        return view('AdminParalelos', compact('paralelos', 'turnos', 'cursos', 'gestiones'));
    }

    public function inscripcion()
    {
        $inscripciones = Inscripciones::all();
        $cursos = CursoParalelos::all();
        $cupos = DB::table('inscripciones')
            ->join('curso_paralelos', 'curso_paralelos.id', '=', 'inscripciones.id_cursos_paralelos')
            ->join('cursos', 'cursos.id', '=', 'curso_paralelos.id_curso')
            ->select(DB::raw('COUNT(inscripciones.id_cursos_paralelos) as total'), 'curso_paralelos.id as existe')
            ->groupBy('inscripciones.id_cursos_paralelos')
            ->get();
        return view('AdminInscripciones', compact('inscripciones', 'cursos', 'cupos'));
    }

    public function asignarMateria()
    {
        $materias = CursoParalelos::all();
        return view('AdminAsignarMateria', compact('materias'));
    }

    public function materiaCursos()
    {
        $materias_cursos = MateriaCursos::orderBy('id_curso', 'desc')->get();
        return view('AdminMateriaCursos', compact('materias_cursos'));
    }

    public function asignarMaterias($ids)
    {

        try {
            $id = Crypt::decrypt($ids);
            session()->put('paralelo-id', $id);
            $idCurso = CursoParalelos::where('id', '=', $id)->value('id_curso');
            $materias = MateriaCursos::where('materia_cursos.id_curso', '=', $idCurso)->get();
            $cursos = CursoParalelos::where('id', '=', $id)->get();
            $asignaciones = AsignarMaterias::where('id_cursos_paralelos', '=', $id)->get();
            return view('AdminAsignarMaterias', compact('asignaciones', 'cursos', 'materias'));
        } catch (\Exception $e) {
            $notificacion = array(
                'message' => 'Pagina no identificada.',
                'alert-type' => 'error'
            );
            return view('errors.404');
        }
    }
}
