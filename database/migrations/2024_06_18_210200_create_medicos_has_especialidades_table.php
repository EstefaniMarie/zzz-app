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
        Schema::create('Medicos_has_Especialidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMedico');
            $table->unsignedBigInteger('idEspecialidad');
            $table->timestamps();

            $table->foreign('idMedico')->references('id')->on('Medicos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idEspecialidad')->references('id')->on('Especialidades')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Medicos_has_especialidades');
    }
};
