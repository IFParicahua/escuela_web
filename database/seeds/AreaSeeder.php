<?php

use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            [
                'nombre' => 'Comunidad y Sociedad',
                'estado' => '0'
            ], [
                'nombre' => 'Ciencia y Tecnologia',
                'estado' => '0'
            ], [
                'nombre' => 'Tierra y Territorio',
                'estado' => '0'
            ], [
                'nombre' => 'Cosmos y Pensamiento',
                'estado' => '0'
            ]
        ]);
    }
}
