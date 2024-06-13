<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleados extends Model
{
    protected $table = 'empleados';

    use HasFactory;

    protected $fillable = [
        'idPersona ',
        'nombre_unidad',
        'codtra'
    ];
}