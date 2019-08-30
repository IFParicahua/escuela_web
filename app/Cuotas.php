<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table = 'cuotas';

    public function cuotaInscripcion()
    {
        return $this->belongsTo(
            'App\Inscripciones',
            'id_inscripcion'
        );
    }
}
