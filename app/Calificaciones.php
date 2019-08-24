<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
    protected $table = 'calificaciones';

    public function calificacionMateria()
    {
        return $this->belongsTo(
            'App\AsignarMaterias',
            'id_asignar_materia'
        );
    }

    public function calificacionInscripcion()
    {
        return $this->belongsTo(
            'App\Inscripciones',
            'id_inscripcion'
        );
    }

    public function calificacionCalificacion()
    {
        return $this->belongsTo(
            'App\TipoCalificaciones',
            'id_tipo_calificaciones'
        );
    }
}
