<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    protected $table = 'consultas';

    use HasFactory;

    protected $fillable = [
        'fechaConsulta',
        'idCita'
    ];
}
