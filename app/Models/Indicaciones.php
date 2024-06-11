<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indicaciones extends Model
{
    protected $table = 'indicaciones';

    use HasFactory;

    protected $fillable = [
        'descripcion',
        'Tratamientos_idTratamientos',
        'Tratamientos_Diagnosticos_idDiagnosticos',
        'Tratamientos_Diagnosticos_Sintomas_idSintomas',
        'Tratamientos_Diagnosticos_Sintomas_Citas_idCitas'
    ];
}