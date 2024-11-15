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
        Schema::create('Medicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario');
            $table->tinyInteger('estatus')->default(1);
            $table->string('colegiatura', 15)->unique();
            $table->string('diasDisponibles');
            $table->string('horasDisponibles');
            $table->timestamps();

            $table->foreign('idUsuario')->references('id')->on('Usuarios')->onDelete('no action')->onUpdate('no action');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Medicos');
    }
};
