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
            $table->integer('idOtros_Asegurados', true);
            $table->integer('Personas_idPersonas')->nullable()->index('fk_otros_asegurados_personas1_idx');
            $table->timestamps();
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
