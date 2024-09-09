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
        Schema::create('Consultas_has_Sintomas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idConsulta');
            $table->unsignedBigInteger('idSintoma');
            $table->timestamps();
            
            $table->foreign('idConsulta')->references('id')->on('Consultas');
            $table->foreign('idSintoma')->references('id')->on('Sintomas');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Consulta_has_Diagnosticos');
    }
};
