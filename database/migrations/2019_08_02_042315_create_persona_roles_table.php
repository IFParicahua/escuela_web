<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_persona');
            $table->foreign('id_persona')->references('id')->on('personas');
            $table->unsignedBigInteger('id_rol');
            $table->foreign('id_rol')->references('id')->on('roles');
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
        Schema::dropIfExists('persona_roles');
    }
}
