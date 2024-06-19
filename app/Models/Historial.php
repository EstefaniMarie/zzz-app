<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    protected $table = 'historialclinico';

    use HasFactory;

    protected $fillable = [
        'idOtroAsegurado',
        'idEmpleado'
    ];
}