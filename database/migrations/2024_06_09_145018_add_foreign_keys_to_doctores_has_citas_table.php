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
        Schema::table('doctores_has_citas', function (Blueprint $table) {
            $table->foreign(['Citas_idCitas'], 'fk_Doctores_has_Citas_Citas1')->references(['idCitas'])->on('citas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Doctores_idDoctores'], 'fk_Doctores_has_Citas_Doctores1')->references(['idDoctores'])->on('doctores')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctores_has_citas', function (Blueprint $table) {
            $table->dropForeign('fk_Doctores_has_Citas_Citas1');
            $table->dropForeign('fk_Doctores_has_Citas_Doctores1');
        });
    }
};
