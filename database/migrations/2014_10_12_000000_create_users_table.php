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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('document');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('user')->unique();
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('telefono');
            $table->integer('rol_id');
            $table->integer('idServicio')->nullable();
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
        Schema::dropIfExists('users');
    }
};
