<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sintomas extends Model
{
    protected $table = 'sintomas';

    use HasFactory;

    protected $fillable = [
        'descripcion',
    ];

    public function consultas()
    {
        return $this->belongsToMany(Consultas::class, 'Consultas_has_Diagnosticos', 'idDiagnostico', 'idConsulta');
    }

    public function diagnosticos()
    {
        return $this->belongsToMany(Diagnosticos::class, 'Sintomas_has_Diagnosticos', 'idSintoma', 'idDiagnostico');
    }

    public function consultasConSintomas()
    {
        return $this->hasMany(ConsultasConSintomas::class, 'idSintoma');
    }
}