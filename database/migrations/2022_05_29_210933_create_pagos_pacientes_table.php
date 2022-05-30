<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_pacientes', function (Blueprint $table) {
            $table->id();
            $table->integer('idPaciente');
            $table->integer('idServicio');
            $table->integer('precio');
            $table->string('observacion');
            $table->integer('metodoPago');
            $table->date('fecha_generacion');
            $table->integer('estado');
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
        Schema::dropIfExists('pagos_pacientes');
    }
};
