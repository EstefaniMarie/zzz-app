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
        Schema::table('sintomas', function (Blueprint $table) {
            $table->foreign(['Citas_idCitas'], 'fk_Sintomas_Citas2')->references(['idCitas'])->on('citas')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sintomas', function (Blueprint $table) {
            $table->dropForeign('fk_Sintomas_Citas2');
        });
    }
};
