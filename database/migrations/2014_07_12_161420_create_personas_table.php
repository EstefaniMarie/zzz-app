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
        Schema::create('Personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 250);
            $table->string('apellidos', 250);
            $table->date('fecha_nacimiento');
            $table->string('cedula', 9)->nullable()->unique();
            $table->string('numero_telefono', 20)->nullable();
            $table->unsignedBigInteger('idGenero');
            $table->timestamps();

            $table->foreign('idGenero')->references('id')->on('Genero')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Personas');
    }
};
