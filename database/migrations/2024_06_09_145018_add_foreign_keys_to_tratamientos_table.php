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
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->foreign(['Diagnosticos_idDiagnosticos', 'Diagnosticos_Sintomas_idSintomas', 'Diagnosticos_Sintomas_Citas_idCitas'], 'fk_Tratamientos_Diagnosticos1')->references(['idDiagnosticos', 'Sintomas_idSintomas', 'Sintomas_Citas_idCitas'])->on('diagnosticos')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->dropForeign('fk_Tratamientos_Diagnosticos1');
        });
    }
};
