<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tratamientos extends Model
{
    protected $table = 'tratamientos';

    use HasFactory;

    protected $fillable = [
        'descripcion',
        'Diagnosticos_idDiagnosticos',
        'Diagnosticos_Sintomas_idSintomas',
        'Diagnosticos_Sintomas_Citas_idCitas'
    ];
}