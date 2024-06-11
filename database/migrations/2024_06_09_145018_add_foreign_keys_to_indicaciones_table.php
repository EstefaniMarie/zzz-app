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
        Schema::table('indicaciones', function (Blueprint $table) {
            $table->foreign(['Tratamientos_idTratamientos', 'Tratamientos_Diagnosticos_idDiagnosticos', 'Tratamientos_Diagnosticos_Sintomas_idSintomas', 'Tratamientos_Diagnosticos_Sintomas_Citas_idCitas'], 'fk_Indicaciones_Tratamientos1')->references(['idTratamientos', 'Diagnosticos_idDiagnosticos', 'Diagnosticos_Sintomas_idSintomas', 'Diagnosticos_Sintomas_Citas_idCitas'])->on('tratamientos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indicaciones', function (Blueprint $table) {
            $table->dropForeign('fk_Indicaciones_Tratamientos1');
        });
    }
};
