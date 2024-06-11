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
        Schema::table('otros_asegurados_has_empleados', function (Blueprint $table) {
            $table->foreign(['Empleados_idEmpleados'], 'fk_Otros_Asegurados_has_Empleados_Empleados1')->references(['idEmpleados'])->on('empleados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Otros_Asegurados_idOtros_Asegurados'], 'fk_Otros_Asegurados_has_Empleados_Otros_Asegurados1')->references(['idOtros_Asegurados'])->on('otros_asegurados')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['Parentesco_idParentesco'], 'fk_Otros_Asegurados_has_Empleados_Parentesco1')->references(['idParentesco'])->on('parentesco')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otros_asegurados_has_empleados', function (Blueprint $table) {
            $table->dropForeign('fk_Otros_Asegurados_has_Empleados_Empleados1');
            $table->dropForeign('fk_Otros_Asegurados_has_Empleados_Otros_Asegurados1');
            $table->dropForeign('fk_Otros_Asegurados_has_Empleados_Parentesco1');
        });
    }
};
