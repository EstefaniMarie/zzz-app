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
        Schema::create('otros_asegurados_has_empleados', function (Blueprint $table) {
            $table->integer('Otros_Asegurados_idOtros_Asegurados')->index('fk_otros_asegurados_has_empleados_otros_asegurados1_idx');
            $table->integer('Empleados_idEmpleados')->index('fk_otros_asegurados_has_empleados_empleados1_idx');
            $table->integer('Parentesco_idParentesco')->index('fk_otros_asegurados_has_empleados_parentesco1_idx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otros_asegurados_has_empleados');
    }
};
