<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medicamentos_citas', function (Blueprint $table) {
            $table->unsignedBigInteger('idCita');
            $table->unsignedBigInteger('idMedicamento');
            $table->unsignedBigInteger('idFarmaceutico');
            $table->timestamps();

            $table->foreign('idCita')->references('id')->on('citas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idMedicamento')->references('id')->on('medicamentos')->onDelete('no action')->onUpdate('no action');
            $table->foreign('idFarmaceutico')->references('id')->on('farmaceutico')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicamentos_citas');
    }
};
