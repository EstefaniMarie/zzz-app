<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->unsignedBigInteger('idPersona');
            $table->unsignedBigInteger('idRol');
            $table->binary('Status');
            $table->dateTime('last_login')->nullable();
            $table->timestamps();

            $table->foreign('idPersona')->references('id')->on('Personas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idRol')->references('id')->on('Roles')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuarios');
    }
};
