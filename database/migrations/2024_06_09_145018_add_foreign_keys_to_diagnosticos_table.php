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
        Schema::table('diagnosticos', function (Blueprint $table) {
            $table->foreign(['Sintomas_idSintomas', 'Sintomas_Citas_idCitas'], 'fk_Diagnosticos_Sintomas1')->references(['idSintomas', 'Citas_idCitas'])->on('sintomas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diagnosticos', function (Blueprint $table) {
            $table->dropForeign('fk_Diagnosticos_Sintomas1');
        });
    }
};
