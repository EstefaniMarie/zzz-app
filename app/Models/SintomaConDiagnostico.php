<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SintomaConDiagnostico extends Model
{
    use HasFactory;

    protected $table = 'Sintomas_has_Diagnosticos';
    protected $fillable = [
        'idSintoma',
        'idDiagnostico'
    ];
}