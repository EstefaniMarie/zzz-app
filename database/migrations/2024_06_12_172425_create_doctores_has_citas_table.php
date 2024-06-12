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
        Schema::create('doctores_has_citas', function (Blueprint $table) {
            $table->unsignedBigInteger('idDoctor');
            $table->unsignedBigInteger('idCita');
            $table->tinyInteger('disponibilidad')->default(0);
            $table->timestamps();

            $table->foreign('idDoctor')->references('id')->on('doctores')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('idCita')->references('id')->on('citas')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores_has_citas');
    }
};
