<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'idPersona'
    ];

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }

    public function citas()
    {
        return $this->hasMany(Citas::class, 'cedulaPaciente', 'cedula');
    }
}
