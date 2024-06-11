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
        Schema::table('historial_clinico', function (Blueprint $table) {
            $table->foreign(['Pacientes_idPacientes'], 'fk_Historial_Clinico_Pacientes1')->references(['idEmpleados'])->on('empleados')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historial_clinico', function (Blueprint $table) {
            $table->dropForeign('fk_Historial_Clinico_Pacientes1');
        });
    }
};
