<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosticos extends Model
{
    protected $table = 'diagnosticos';

    use HasFactory;

    protected $fillable = [
        'descripcion',
        'Sintomas_idSintomas',
        'Sintomas_Citas_idCitas'
    ];
}