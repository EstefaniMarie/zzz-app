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
            $table->id();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->unsignedBigInteger('idPersona');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->foreign('idPersona')->references('id')->on('personas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
