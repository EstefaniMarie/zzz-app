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
        Schema::create('indicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 2500);
            $table->unsignedBigInteger('idTratamiento');
            $table->unsignedBigInteger('idDiagnostico');
            $table->unsignedBigInteger('idSintoma');
            $table->unsignedBigInteger('idCita');
            $table->timestamps();

            $table->foreign('idTratamiento')->references('id')->on('tratamientos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idDiagnostico')->references('id')->on('tratamientos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idSintoma')->references('id')->on('tratamientos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idCita')->references('id')->on('tratamientos')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicaciones');
    }
};
