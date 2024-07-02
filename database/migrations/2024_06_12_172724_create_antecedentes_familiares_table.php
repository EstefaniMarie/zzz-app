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
        Schema::create('AntecedentesFamiliares', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 2000);
            $table->string('descripcion', 2000);
            $table->unsignedBigInteger('idPersona');
            $table->unsignedBigInteger('idOtroAsegurado')->nullable();
            $table->timestamps();

            $table->foreign('idPersona')->references('id')->on('Personas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idOtroAsegurado')->references('id')->on('OtrosAsegurados')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('AntecedentesFamiliares');
    }
};
