<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctoresConConsultas extends Model
{
    protected $table = 'doctores_has_consultas';

    use HasFactory;

    protected $fillable = [
        'idDoctor',
        'idConsulta',
        'disponibilidad'
    ];
}