<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    public function profesorPersona()
    {
        return $this->belongsTo(
            'App\Personas',
            'id_persona'
        );
    }
}
