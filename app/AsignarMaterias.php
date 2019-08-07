<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsignarMaterias extends Model
{
    protected $table = 'asignar_materias';

    public function asignarMateria()
    {
        return $this->belongsTo(
            'App\Materias',
            'id_materia'
        );
    }

    public function asignarProfesor()
    {
        return $this->belongsTo(
            'App\Profesores',
            'id_profesores'
        );
    }

    public function asignarParalelo()
    {
        return $this->belongsTo(
            'App\CursoParalelos',
            'id_cursos_paralelos'
        );
    }
}
