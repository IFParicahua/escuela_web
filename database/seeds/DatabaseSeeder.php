<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AreaSeeder::class);
        $this->call(GestionSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(TipoCalificacionSeeder::class);
        $this->call(TurnoSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PersonaSeeder::class);
    }
}
