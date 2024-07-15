<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diagnosticos extends Model
{
    protected $table = 'diagnosticos';

    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
    ];

    public function consultas()
    {
        return $this->belongsToMany(Consultas::class, 'Consultas_has_Diagnosticos', 'idDiagnostico', 'idConsulta');
    }

    public function tratamientos()
    {
        return $this->belongsToMany(Tratamientos::class, 'Diagnosticos_has_Tratamientos', 'idDiagnostico', 'idTratamiento');
    }

    public function diagnosticoConConsultas()
    {
        return $this->hasMany(ConsultaConDiagnosticos::class, 'idDiagnostico');
    }
}
