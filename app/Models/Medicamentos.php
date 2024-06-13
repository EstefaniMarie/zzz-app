<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicamentos extends Model
{
    protected $table = 'medicamentos';

    use HasFactory;

    protected $fillable = [
        'nombreMedicamento',
        'presentacion',
        'disponible',
        'descripcion'
    ];
}