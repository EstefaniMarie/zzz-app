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
        Schema::create('antecedentes_personales', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 2000);
            $table->string('descripcion', 2000);
            $table->unsignedBigInteger('idHistorialClinico');
            $table->timestamps();

            $table->foreign('idHistorialClinico')->references('id')->on('historial_clinico')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_personales');
    }
};
