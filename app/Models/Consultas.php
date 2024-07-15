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
        return $this->belongsToMany(Diagnosticos::class, 'Consultas_has_Diagnosticos', 'idConsulta', 'idDiagnostico');
    }

    public function medicos()
    {
        return $this->belongsToMany(Medicos::class, 'medicos_has_consultas', 'idConsulta', 'idMedico');
    }
}
