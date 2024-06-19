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
        Schema::create('HistorialClinico', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOtrosAsegurado')->nullable();
            $table->unsignedBigInteger('idEmpleado')->nullable();
            $table->timestamps();

            $table->foreign('idOtrosAsegurado')->references('id')->on('OtrosAsegurados')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idEmpleado')->references('id')->on('Empleados')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('HistorialClinico');
    }
};
