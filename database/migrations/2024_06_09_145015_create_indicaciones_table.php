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
        Schema::create('indicaciones', function (Blueprint $table) {
            $table->integer('idIndicaciones', true)->unique('idindicaciones_unique');
            $table->string('descripcion', 2500);
            $table->integer('Tratamientos_idTratamientos');
            $table->integer('Tratamientos_Diagnosticos_idDiagnosticos');
            $table->integer('Tratamientos_Diagnosticos_Sintomas_idSintomas');
            $table->integer('Tratamientos_Diagnosticos_Sintomas_Citas_idCitas');
            $table->timestamps();
            $table->index(['Tratamientos_idTratamientos', 'Tratamientos_Diagnosticos_idDiagnosticos', 'Tratamientos_Diagnosticos_Sintomas_idSintomas', 'Tratamientos_Diagnosticos_Sintomas_Citas_idCitas'], 'fk_indicaciones_tratamientos1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicaciones');
    }
};
