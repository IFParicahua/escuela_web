<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonaRoles extends Model
{
    protected $table = 'persona_roles';

    public function personaRol()
    {
        return $this->hasMany(
            'App\Roles',
            'id'
        );
    }
}
