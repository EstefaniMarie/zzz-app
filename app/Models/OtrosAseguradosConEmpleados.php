<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtrosAseguradosConEmpleados extends Model
{
    protected $table = 'otros_asegurados_empleados';

    use HasFactory;

    protected $fillable = [
        'idOtrosAsegurado',
        'idEmpleado',
        'idParentesco'
    ];
}