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
        Schema::create('sintomas', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 2500);
            $table->unsignedBigInteger('idCita');
            $table->timestamps();

            $table->foreign('idCita')->references('id')->on('citas')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintomas');
    }
};
