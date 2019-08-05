<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoParalelos extends Model
{
    protected $table = 'curso_paralelos';

    public function paraleloCurso()
    {
        return $this->belongsTo(
            'App\Cursos',
            'id_curso'
        );
    }

    public function paraleloTurno()
    {
        return $this->belongsTo(
            'App\Turnos',
            'id_turno'
        );
    }

    public function paraleloGestion()
    {
        return $this->belongsTo(
            'App\Gestiones',
            'id_gestion'
        );
    }
}
