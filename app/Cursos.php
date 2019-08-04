<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    public function cursoNivel()
    {
        return $this->belongsTo(
            'App\Niveles',
            'id_nivel'
        );
    }
}
