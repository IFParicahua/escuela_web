<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutores extends Model
{
    protected $table = 'tutores';

    public function tutorPersona()
    {
        return $this->belongsTo(
            'App\Personas',
            'id_persona'
        );
    }
}
