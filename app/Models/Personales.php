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
        'idHistorial_Clinico'
    ];
}