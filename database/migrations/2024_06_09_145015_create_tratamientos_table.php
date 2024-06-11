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
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->integer('idTratamientos', true)->unique('idtratamientos_unique');
            $table->string('descripcion', 2500);
            $table->integer('Diagnosticos_idDiagnosticos');
            $table->integer('Diagnosticos_Sintomas_idSintomas');
            $table->integer('Diagnosticos_Sintomas_Citas_idCitas');
            $table->timestamps();
            $table->index(['idTratamientos', 'Diagnosticos_idDiagnosticos', 'Diagnosticos_Sintomas_idSintomas', 'Diagnosticos_Sintomas_Citas_idCitas'], 'fk_tratamientos_diagnosticos1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
