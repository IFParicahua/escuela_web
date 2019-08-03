<?php

use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveles')->insert([
            [
                'nombre' => 'Nidito',
                'estado' => '0'
            ], [
                'nombre' => 'Primaria',
                'estado' => '0'
            ], [
                'nombre' => 'Secundaria',
                'estado' => '0'
            ]
        ]);
    }
}
