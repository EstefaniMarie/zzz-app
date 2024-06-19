<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctoresConEspecialidades extends Model
{
    use HasFactory;

    protected $table = 'doctores_has_especialidades';

    protected $fillable = [
        'idDoctor',
        'idEspecialidad'
    ];
}
