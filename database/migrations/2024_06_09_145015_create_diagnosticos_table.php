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
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->integer('idDiagnosticos', true)->unique('iddiagnosticos_unique');
            $table->string('descripcion', 2500);
            $table->integer('Sintomas_idSintomas');
            $table->integer('Sintomas_Citas_idCitas');
            $table->timestamps();
            $table->index(['idDiagnosticos', 'Sintomas_idSintomas', 'Sintomas_Citas_idCitas'], 'fk_diagnosticos_sintomas1_idx');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnosticos');
    }
};
