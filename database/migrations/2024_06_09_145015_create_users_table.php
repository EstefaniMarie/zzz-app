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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true)->unique('idusuarios_unique');
            $table->string('email')->nullable()->unique('correo_unique');
            $table->string('password');
            $table->timestamp('last_login')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->integer('Personas_idPersonas')->index('fk_usuarios_personas1_idx')->unique('Personas_idPersonas_unique');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');

    }
};
