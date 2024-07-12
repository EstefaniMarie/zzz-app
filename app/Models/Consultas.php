<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    protected $table = 'consultas';

    use HasFactory;

    protected $fillable = [
        'fechaConsulta',
        'idCita'
    ];

    public function cita()
    {
        return $this->belongsTo(Citas::class, 'idCita');
    }

    public function diagnosticos()
    {
        return $this->hasManyThrough(Diagnosticos::class, ConsultaConDiagnosticos::class, 'idConsulta', 'id', 'id', 'idDiagnostico');
    }
}
