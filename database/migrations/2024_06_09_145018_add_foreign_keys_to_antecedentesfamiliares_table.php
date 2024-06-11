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
        Schema::table('antecedentesfamiliares', function (Blueprint $table) {
            $table->foreign(['idantecedentesPersonales'], 'fk_antecedentesFamiliares_antecedentesPersonales1')->references(['idantecedentesPersonales'])->on('antecedentespersonales')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('antecedentesfamiliares', function (Blueprint $table) {
            $table->dropForeign('fk_antecedentesFamiliares_antecedentesPersonales1');
        });
    }
};
