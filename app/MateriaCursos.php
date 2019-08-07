<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MateriaCursos extends Model
{
    protected $table = 'materia_cursos';

    public function materiaCurso()
    {
        return $this->belongsTo(
            'App\Cursos',
            'id_curso'
        );
    }

    public function materiaMateria()
    {
        return $this->belongsTo(
            'App\Materias',
            'id_materia'
        );
    }
}
