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
        Schema::create('diagnostico_tratamiento_create', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idDiagnotisco');
            $table->unsignedBigInteger('idTratamiento');
            $table->timestamps();

            $table->foreign('idTratamiento')->references('id')->on('Tratamientos')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('idDiagnotisco')->references('id')->on('Diagnosticos')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostico_tratamiento_create');
    }
};
