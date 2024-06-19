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
        Schema::create('AntecedentesPersonales', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 2000);
            $table->string('descripcion', 2000);
            $table->unsignedBigInteger('idHistorialClinico');
            $table->unsignedBigInteger('idPersona');
            $table->unsignedBigInteger('idAntecedenteFamiliar');
            $table->timestamps();

            $table->foreign('idHistorialClinico')->references('id')->on('HistorialClinico')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('idPersona')->references('id')->on('Personas')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('idAntecedenteFamiliar')->references('id')->on('AntecedentesFamiliares')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AntecedentesPersonales');
    }
};
