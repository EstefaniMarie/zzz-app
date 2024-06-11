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
        Schema::table('doctores', function (Blueprint $table) {
            $table->foreign(['Usuarios_idUsuarios'], 'fk_Doctores_Usuarios1')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctores', function (Blueprint $table) {
            $table->dropForeign('fk_Doctores_Usuarios1');
        });
    }
};
