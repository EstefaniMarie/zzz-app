<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familiares extends Model
{
    protected $table = 'antecedentesfamiliares';

    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
        'idPersona',
        'idOtroAsegurado'
    ];

    public function antecedentesPersonales() {
        return $this->belongsTo(Personales::class, 'idAntecedenteFamiliar', 'id');
    }

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }
}