<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comportamientos extends Model
{
    protected $table = 'comportamientos';

    public function compMateria()
    {
        return $this->belongsTo(
            'App\AsignarMaterias',
            'id_asignar_materia'
        );
    }

    public function compInscripcion()
    {
        return $this->belongsTo(
            'App\Inscripciones',
            'id_inscripcion'
        );
    }
}
