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
        Schema::create('otros_asegurados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idPersona');
            $table->timestamps();

            $table->foreign('idPersona')->references('id')->on('personas')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otros_asegurados');
    }
};
