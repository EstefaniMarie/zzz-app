<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personas extends Model
{
    protected $table = 'personas';

    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'codtra',
        'correo',
        'numero_telefono',
        'Genero_idGenero',
        'Otros_Asegurados_idOtros_Asegurados',
        'cedula'
    ];

    public function empleado()
    {
        return $this->hasOne(Empleado::class);
    }

    public function otrosAsegurado()
    {
        return $this->hasOne(OtroAsegurado::class);
    }
}