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
        Schema::create('Medicos_has_Consultas', function (Blueprint $table) {
            $table->unsignedBigInteger('idMedico');
            $table->unsignedBigInteger('idConsulta');
            $table->tinyInteger('disponibilidad')->default(1);
            $table->timestamps();

            $table->foreign('idMedico')->references('id')->on('Medicos')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('idConsulta')->references('id')->on('Consultas')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Medicos_has_Citas');
    }
};
