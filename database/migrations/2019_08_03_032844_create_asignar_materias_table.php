<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignarMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_materias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha_asignacion');
            $table->unsignedBigInteger('id_materia');
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->unsignedBigInteger('id_profesores');
            $table->foreign('id_profesores')->references('id')->on('profesores');
            $table->unsignedBigInteger('id_cursos_paralelos');
            $table->foreign('id_cursos_paralelos')->references('id')->on('curso_paralelos');
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
        Schema::dropIfExists('asignar_materias');
    }
}
