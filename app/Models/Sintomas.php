<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sintomas extends Model
{
    protected $table = 'sintomas';

    use HasFactory;

    protected $fillable = [
        'descripcion',
        'Citas_idCitas'
    ];
}