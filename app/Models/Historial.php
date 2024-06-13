<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    protected $table = 'historial_clinico';

    use HasFactory;

    protected $fillable = [
        'idOtrosAsegurado',
        'idEmpleado'
    ];
}