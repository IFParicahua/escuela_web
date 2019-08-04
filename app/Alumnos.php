<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    public function alumnoPersona()
    {
        return $this->belongsTo(
            'App\Personas',
            'id_persona'
        );
    }

    public function alumnoTutor()
    {
        return $this->belongsTo(
            'App\Tutores',
            'idtutor'
        );
    }
}
