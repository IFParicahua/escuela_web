<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_calificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 20);
            $table->dateTime('fecha_inicial');
            $table->dateTime('fecha_final');
            $table->char('estado', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_calificaciones');
    }
}
