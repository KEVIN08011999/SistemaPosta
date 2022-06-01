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
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->integer('idCita');
            $table->integer('idTriaje');
            $table->integer('idPaciente');
            $table->text('motivo')->nullable();
            $table->text('antecedentes')->nullable();
            $table->integer('tiempo_enfermedad')->nullable();
            $table->string('alergias')->nullable();
            $table->string('intervenciones')->nullable();
            $table->integer('vacunas')->nullable();
            $table->text('examen')->nullable();
            $table->text('diagostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->integer('tipo_diagnostico')->nullable();
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('diagnosticos');
    }
};
