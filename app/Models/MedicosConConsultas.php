<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicosConConsultas extends Model
{
    protected $table = 'medicos_has_consultas';

    use HasFactory;

    protected $fillable = [
        'idMedico',
        'idConsulta',
        'disponibilidad',
    ];

    public function medico()
    {
        return $this->belongsTo(Medicos::class, 'idMedico', 'id');
    }

    public function consulta()
    {
        return $this->belongsTo(Consultas::class, 'idConsulta');
    }
}
