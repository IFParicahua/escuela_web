<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asistencias extends Model
{
    protected $table = 'asistencia';

    public function aistenciaInscripcion()
    {
        return $this->belongsTo(
            'App\Inscripciones',
            'id_inscripcion'
        );
    }
}
