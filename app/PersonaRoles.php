<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaRoles extends Model
{
    protected $table = 'persona_roles';

    public function personaRol()
    {
        return $this->belongsTo(
            'App\Personas',
            'id_persona'
        );
    }

    public function rolRoles()
    {
        return $this->belongsTo(
            'App\Roles',
            'id_rol'
        );
    }
}
