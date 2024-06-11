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
        Schema::table('medicamentos_citas', function (Blueprint $table) {
            $table->foreign(['Citas_idCitas'], 'fk_entregaMedicamento_Citas1')->references(['idCitas'])->on('citas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['idRegistro_Medicamentos'], 'fk_entregaMedicamento_Registro_Medicamentos1')->references(['idRegistro_Medicamentos'])->on('medicamentos')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Farmaceutico_idFarmaceutico'], 'fk_Medicamentos_Citas_Farmaceutico1')->references(['idFarmaceutico'])->on('farmaceutico')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medicamentos_citas', function (Blueprint $table) {
            $table->dropForeign('fk_entregaMedicamento_Citas1');
            $table->dropForeign('fk_entregaMedicamento_Registro_Medicamentos1');
            $table->dropForeign('fk_Medicamentos_Citas_Farmaceutico1');
        });
    }
};
