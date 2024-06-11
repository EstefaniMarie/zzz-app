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
        Schema::create('doctores_has_citas', function (Blueprint $table) {
            $table->integer('Doctores_idDoctores')->index('fk_doctores_has_citas_doctores1_idx');
            $table->integer('Citas_idCitas')->index('fk_doctores_has_citas_citas1_idx');
            $table->boolean('disponibilidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores_has_citas');
    }
};
