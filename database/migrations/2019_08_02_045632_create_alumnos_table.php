<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('nacimiento');
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->unsignedBigInteger('idtutor');
            $table->foreign('idtutor')->references('id')->on('tutores');
            $table->integer('rude');
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
        Schema::dropIfExists('alumnos');
    }
}
