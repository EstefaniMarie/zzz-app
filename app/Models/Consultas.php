<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    protected $table = 'consultas';

    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'idCita'
    ];

    public function cita()
    {
        return $this->belongsTo(Citas::class, 'idCita');
    }

    public function sintomas()
    {
        return $this->belongsToMany(Sintomas::class, 'Consultas_has_Sintomas', 'idConsulta', 'idSintoma');
    }

    public function medicos()
    {
        return $this->belongsToMany(Medicos::class, 'medicos_has_consultas', 'idConsulta', 'idMedico');
    }
}
