<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleados extends Model
{
    protected $table = 'empleados';

    use HasFactory;

    protected $fillable = [
        'idPacientes',
        'nombre_unidad',
        'codigoTrabajador',
        'estatus'
    ];

    public function historialesClinicos() {
        return $this->hasMany(Historial::class, 'idEmpleado', 'id');
    }

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }

    public function pacientes() {
        return $this->belongsTo(Pacientes::class, 'idPacientes', 'id');
    }
}
