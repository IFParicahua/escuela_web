<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscripciones extends Model
{
    protected $table = 'inscripciones';

    public function inscripcionAlumno()
    {
        return $this->belongsTo(
            'App\Alumnos',
            'id_alumno'
        );
    }

    public function inscripcionParalelo()
    {
        return $this->belongsTo(
            'App\CursoParalelos',
            'id_cursos_paralelos'
        );
    }
}
