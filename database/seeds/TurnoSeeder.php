<?php

use Illuminate\Database\Seeder;

class TurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('turnos')->insert([
            [
                'nombre' => 'Mañana',
                'estado' => '0'
            ], [
                'nombre' => 'Tarde',
                'estado' => '0'
            ]
        ]);
    }
}
