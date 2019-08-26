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
                'fecha_inicial' => '2019-01-14',
                'fecha_final' => '2019-04-08',
                'estado' => '1'
            ], [
                'nombre' => 'Segundo Bimestre',
                'fecha_inicial' => '2019-04-09',
                'fecha_final' => '2019-06-14',
                'estado' => '1'
            ], [
                'nombre' => 'Tercer Bimestre',
                'fecha_inicial' => '2019-06-15',
                'fecha_final' => '2019-09-09',
                'estado' => '0'
            ], [
                'nombre' => 'Cuarto Bimestre',
                'fecha_inicial' => '2019-09-10',
                'fecha_final' => '2019-11-29',
                'estado' => '1'
            ]
        ]);
    }
}
