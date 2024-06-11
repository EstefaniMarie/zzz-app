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
        Schema::create('personas', function (Blueprint $table) {
            $table->integer('idPersonas', true)->unique('idpersonas_unique');
            $table->string('nombres', 250);
            $table->string('apellidos', 250);
            $table->date('fecha_nacimiento');
            $table->string('codtra', 9)->nullable()->unique('codtra_unique');
            $table->string('numero_telefono', 20)->nullable();
            $table->integer('Genero_idGenero')->index('fk_personas_genero1_idx');
            $table->string('cedula', 9);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
