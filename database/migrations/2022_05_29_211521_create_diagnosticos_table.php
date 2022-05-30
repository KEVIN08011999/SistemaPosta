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
            $table->text('motivo');
            $table->text('antecedentes');
            $table->integer('tiempo_enfermedad');
            $table->string('alergias');
            $table->string('intervenciones');
            $table->integer('vacunas');
            $table->text('examen');
            $table->text('diagostico');
            $table->text('tratamiento');
            $table->integer('tipo_diagnostico');
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
