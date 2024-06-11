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
        Schema::create('medicamentos_citas', function (Blueprint $table) {
            $table->integer('identregaMedicamento', true)->unique('identregamedicamento_unique');
            $table->integer('Citas_idCitas')->index('fk_entregamedicamento_citas1_idx');
            $table->integer('idRegistro_Medicamentos')->index('fk_entregamedicamento_registro_medicamentos1_idx');
            $table->integer('Farmaceutico_idFarmaceutico')->index('fk_medicamentos_citas_farmaceutico1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_citas');
    }
};
