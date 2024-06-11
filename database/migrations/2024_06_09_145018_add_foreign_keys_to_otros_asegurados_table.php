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
        Schema::table('otros_asegurados', function (Blueprint $table) {
            $table->foreign(['Personas_idPersonas'], 'fk_Otros_Asegurados_Personas1')->references(['idPersonas'])->on('personas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otros_asegurados', function (Blueprint $table) {
            $table->dropForeign('fk_Otros_Asegurados_Personas1');
        });
    }
};
