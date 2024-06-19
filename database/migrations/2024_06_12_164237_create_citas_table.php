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
        Schema::create('Citas', function (Blueprint $table) {
            $table->id();
            $table->string('cedulaPaciente', 45)->unique();
            $table->string('cedulaDoctor', 45)->unique();
            $table->timestamps();

            $table->foreign('cedulaPaciente')->references('cedula')->on('Personas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('cedulaDoctor')->references('cedula')->on('Personas')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Citas');
    }
};
