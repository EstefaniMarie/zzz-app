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
        Schema::table('antecedentespersonales', function (Blueprint $table) {
            $table->foreign(['idHistorial_Clinico'], 'fk_antecedentesPersonales_Historial_Clinico1')->references(['idHistorial_Clinico'])->on('historial_clinico')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antecedentespersonales', function (Blueprint $table) {
            $table->dropForeign('fk_antecedentesPersonales_Historial_Clinico1');
        });
    }
};
