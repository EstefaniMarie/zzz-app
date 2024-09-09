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
        Schema::create('Sintomas_has_Diagnosticos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSintoma');
            $table->unsignedBigInteger('idDiagnostico');
            $table->timestamps();
            
            $table->foreign('idSintoma')->references('id')->on('Sintomas');
            $table->foreign('idDiagnostico')->references('id')->on('Diagnosticos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Sintomas_has_Diagnosticos');
    }
};
