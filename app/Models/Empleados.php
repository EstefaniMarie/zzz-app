<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleados extends Model
{
    protected $table = 'empleados';

    use HasFactory;

    protected $fillable = [
        'Personas_idPersonas ',
        'nombre_unidad'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function otrosAsegurados()
    {
        return $this->belongsToMany(OtroAsegurado::class, 'empleado_otros_asegurados')
                    ->withPivot('parentesco_id')
                    ->withTimestamps();
    }
}