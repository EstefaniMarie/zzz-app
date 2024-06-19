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
        Schema::create('Consultas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fechaConsulta');
            $table->unsignedBigInteger
            ('idCita');
            $table->timestamps();

            $table->foreign('idCita')->references('id')->on('Citas')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
