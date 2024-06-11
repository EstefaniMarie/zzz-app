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
        Schema::create('antecedentesfamiliares', function (Blueprint $table) {
            $table->integer('idantecedentesFamiliares', true)->unique('idantecedentesfamiliares_unique');
            $table->string('tipo', 2500);
            $table->string('descripcion', 2500);
            $table->integer('idantecedentesPersonales')->index('fk_antecedentesfamiliares_antecedentespersonales1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentesfamiliares');
    }
};
