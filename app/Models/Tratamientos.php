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
        'idDiagnostico',
        'idSintoma',
        'idCita'
    ];
    public function diagnosticos()
    {
        return $this->belongsToMany(Consultas::class, 'Diagnosticos_has_Tratamientos', 'idDiagnosticos', 'idTratamiento');
    }
}
