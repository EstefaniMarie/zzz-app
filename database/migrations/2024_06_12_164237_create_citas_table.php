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
            $table->string('cedulaPaciente', 9);
            $table->string('cedulaMedico', 9);
            $table->timestamps();

            $table->foreign('cedulaPaciente')->references('cedula')->on('Personas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('cedulaMedico')->references('cedula')->on('Personas')->onDelete('no action')->onUpdate('no action');
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
