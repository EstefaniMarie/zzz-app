<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicosConEspecialidades extends Model
{
    use HasFactory;

    protected $table = 'medicos_has_especialidades';

    protected $fillable = [
        'idMedico',
        'idEspecialidad'
    ];
}