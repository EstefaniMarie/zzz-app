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
        Schema::create('antecedentes_familiares', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 2000);
            $table->string('descripcion', 2000);
            $table->unsignedBigInteger('idPersonales');
            $table->timestamps();

            $table->foreign('idPersonales')->references('id')->on('antecedentes_personales')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antecedentes_familiares');
    }
};
