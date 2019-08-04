<?php

namespace App\Http\Controllers;


use App\Alumnos;
use App\Areas;
use App\Cursos;
use App\Gestiones;
use App\Materias;
use App\Niveles;
use App\Profesores;
use App\TipoCalificaciones;
use App\Turnos;
use App\Tutores;

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

}
