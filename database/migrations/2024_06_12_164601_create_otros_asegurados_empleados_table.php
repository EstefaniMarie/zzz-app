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
        Schema::create('otrosasegurados_empleados', function (Blueprint $table) {
            $table->unsignedBigInteger('idOtroAsegurado')->nullable();
            $table->unsignedBigInteger('idEmpleado')->nullable();
            $table->unsignedBigInteger('idParentesco');
            $table->timestamps();

            $table->foreign('idOtroAsegurado')->references('id')->on('OtrosAsegurados')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idEmpleado')->references('id')->on('Empleados')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idParentesco')->references('id')->on('Parentescos')->onDelete('no action')->onUpdate('no action');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OtrosAsegurados_Empleados');
    }
};
