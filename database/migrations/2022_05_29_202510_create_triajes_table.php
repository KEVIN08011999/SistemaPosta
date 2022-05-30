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
        Schema::create('triajes', function (Blueprint $table) {
            $table->id();
            $table->integer('idCita');
            $table->integer('presion');
            $table->integer('temperatura');
            $table->integer('cardiaca');
            $table->integer('saturacion');
            $table->float('peso');
            $table->integer('talla');
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
        Schema::dropIfExists('triajes');
    }
};
