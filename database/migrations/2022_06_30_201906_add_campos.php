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
        Schema::table('citas', function (Blueprint $table) {
            $table->integer('sis')->nullable();
            $table->integer('prioridad')->nullable();
            $table->string('archivo')->nullable();
        });

        Schema::table('relacion_ventas', function (Blueprint $table) {
            $table->integer('exonerado')->nullable();
        });

        Schema::table('ventas', function (Blueprint $table) {
            $table->integer('tipo_paciente')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
