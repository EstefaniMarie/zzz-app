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
        Schema::create('OtrosAsegurados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPersona');
            $table->unsignedBigInteger('idParentesco');
            $table->timestamps();

            $table->foreign('idPersona')->references('id')->on('Personas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idParentesco')->references('id')->on('Parentescos')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OtrosAsegurados');
    }
};