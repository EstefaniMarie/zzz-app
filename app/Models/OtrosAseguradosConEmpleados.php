<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtrosAseguradosConEmpleados extends Model
{
    protected $table = 'otros_asegurados_has_empleados';

    use HasFactory;

    protected $fillable = [
        'Otros_Asegurados_idOtros_Asegurados',
        'Empleados_idEmpleados',
        'Parentesco_idParentesco'
    ];
}