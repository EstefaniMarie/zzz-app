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
        Schema::create('antecedentespersonales', function (Blueprint $table) {
            $table->integer('idantecedentesPersonales', true)->unique('idantecedentespersonales_unique');
            $table->string('tipo', 2500);
            $table->string('descripcion', 2500);
            $table->integer('idHistorial_Clinico')->index('fk_antecedentespersonales_historial_clinico1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentespersonales');
    }
};
