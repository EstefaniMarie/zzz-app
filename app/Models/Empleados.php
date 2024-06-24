<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleados extends Model
{
    protected $table = 'empleados';

    use HasFactory;

    protected $fillable = [
        'idPersona ',
        'nombre_unidad',
        'codigoTrabajador',
        'idParentesco'
    ];

    public function historialesClinicos() {
        return $this->hasMany(Historial::class, 'idEmpleado', 'id');
    }

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }
}