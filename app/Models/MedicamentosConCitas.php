<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicamentosConCitas extends Model
{
    protected $table = 'medicamentos_citas';

    use HasFactory;

    protected $fillable = [
        'Citas_idCitas',
        'idRegistro_Medicamentos',
        'Farmaceutico_idFarmaceutico'
    ];
}