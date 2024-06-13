<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familiares extends Model
{
    protected $table = 'antecedentes_familiares';

    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
        'idPersonales'
    ];
}