<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtrosAsegurados extends Model
{
    protected $table = 'otros_asegurados';

    use HasFactory;

    protected $fillable = [
        'Personas_idPersonas'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_otros_asegurados')
                    ->withPivot('parentesco_id')
                    ->withTimestamps();
    }

}