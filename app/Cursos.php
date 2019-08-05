<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    protected $table = 'cursos';
    public function cursoNivel()
    {
        return $this->belongsTo(
            'App\Niveles',
            'id_nivel'
        );
    }
}
