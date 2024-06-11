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
        Schema::create('sintomas', function (Blueprint $table) {
            $table->integer('idSintomas', true)->unique('idsintomas_unique');
            $table->string('descripcion', 2500);
            $table->integer('Citas_idCitas');
            $table->timestamps();
            $table->index(['idSintomas', 'Citas_idCitas']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintomas');
    }
};
