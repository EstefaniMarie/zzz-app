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
        Schema::create('Consultas_has_Diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idConsulta');
            $table->unsignedBigInteger('idDiagnostico');
            $table->timestamps();
            
            $table->foreign('idConsulta')->references('id')->on('Consultas');
            $table->foreign('idDiagnostico')->references('id')->on('Diagnosticos');
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
