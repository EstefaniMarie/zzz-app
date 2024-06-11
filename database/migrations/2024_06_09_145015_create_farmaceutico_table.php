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
        Schema::create('farmaceutico', function (Blueprint $table) {
            $table->integer('idFarmaceutico', true)->unique('idfarmaceutico_unique');
            $table->integer('Usuarios_idUsuarios')->index('fk_farmaceutico_usuarios1_idx')->unique('Usuarios_idUsuarios_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmaceutico');
    }
};
