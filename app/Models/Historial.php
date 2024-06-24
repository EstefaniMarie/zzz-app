<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    protected $table = 'historialclinico';

    use HasFactory;

    protected $fillable = [
        'idOtroAsegurado',
        'idEmpleado'
    ];

    public function empleados() {
        return $this->belongsTo(Empleados::class, 'idEmpleado', 'id');
    }

    public function otrosAsegurados() {
        return $this->belongsTo(OtrosAsegurados::class, 'idOtroAsegurado', 'id');
    }
}