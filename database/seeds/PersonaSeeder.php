<?php

use Illuminate\Database\Seeder;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            'nombre' => 'Carlos',
            'apellidopat' => 'Perez',
            'apellidomat' => 'Perez',
            'direccion' => 'Av.Banzer',
            'ci' => '9765437Lp',
            'telefono' => '7777777',
            'sexo' => 'M'
        ]);
    }
}
