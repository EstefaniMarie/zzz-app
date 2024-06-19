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
        Schema::create('Doctores_Consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idDoctor');
            $table->unsignedBigInteger('idConsulta');
            $table->timestamps();

            $table->foreign('idDoctor')->references('id')->on('Doctores')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('idConsulta')->references('id')->on('Consultas')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Doctores_Consultas');
    }
};
