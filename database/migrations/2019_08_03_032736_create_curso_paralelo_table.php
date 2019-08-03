<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoParaleloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_paralelos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_turno');
            $table->foreign('id_turno')->references('id')->on('turnos');
            $table->unsignedBigInteger('id_curso');
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->unsignedBigInteger('id_gestion');
            $table->foreign('id_gestion')->references('id')->on('gestiones');
            $table->string('nombre', 10);
            $table->integer('cupo_maximo');
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
        Schema::dropIfExists('curso_paralelos');
    }
}
