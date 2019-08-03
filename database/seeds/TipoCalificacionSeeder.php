<?php

use Illuminate\Database\Seeder;

class TipoCalificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_calificaciones')->insert([
            [
                'nombre' => 'Primer Bimestre',
                'fecha_inicial' => '2019-01-01',
                'fecha_final' => '2019-12-31',
                'estado' => '0'
            ], [
                'nombre' => 'Segundo Bimestre',
                'fecha_inicial' => '2019-01-01',
                'fecha_final' => '2019-12-31',
                'estado' => '0'
            ], [
                'nombre' => 'Tercer Bimestre',
                'fecha_inicial' => '2019-01-01',
                'fecha_final' => '2019-12-31',
                'estado' => '0'
            ], [
                'nombre' => 'Cuarto Bimestre',
                'fecha_inicial' => '2019-01-01',
                'fecha_final' => '2019-12-31',
                'estado' => '0'
            ]
        ]);
    }
}
