<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personales extends Model
{
    protected $table = 'antecedentespersonales';

    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
        'idHistorialClinico',
        'idPersona',
        'idAntecedenteFamiliar'
    ];

    public function antecedentesFamiliares() {
        return $this->hasMany(Familiares::class, 'idAntecedenteFamiliar', 'id');
    }

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }
}