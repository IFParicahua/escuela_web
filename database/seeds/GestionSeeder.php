<?php

use Illuminate\Database\Seeder;

class GestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gestiones')->insert([
            'fecha_inicial' => '2019-01-01',
            'fecha_final' => '2019-12-31',
            'nombre' => 'Inicio',
            'descripcion' => 'Inicio de clases',
            'estado' => '0'
        ]);
    }
}
