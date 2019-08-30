<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('numero_mes')->nullable();
            $table->decimal('monto', 10, 2)->nullable();
            $table->char('estado', 1);
            $table->dateTime('fecha_pago')->nullable();
            $table->string('descripcion_cuo', 40)->nullable();
            $table->unsignedBigInteger('id_inscripcion');
            $table->foreign('id_inscripcion')->references('id')->on('inscripciones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuotas');
    }
}
