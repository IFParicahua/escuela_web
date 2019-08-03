<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['categoria_rol' => 'Administrador'],
            ['categoria_rol' => 'Contador'],
            ['categoria_rol' => 'Regente'],
            ['categoria_rol' => 'Profesor'],
            ['categoria_rol' => 'Padre']
        ]);
    }
}
