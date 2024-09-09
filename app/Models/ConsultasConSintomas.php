<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultasConSintomas extends Model
{
    use HasFactory;

    protected $table = 'Consultas_has_Sintomas';
    protected $fillable = [
        'idConsulta',
        'idSintoma'
    ];

    public function sintoma()
    {
        return $this->belongsTo(Sintomas::class, 'idSintoma', 'id');
    }

    public function consultasConSintomas()
    {
        return $this->hasMany(ConsultasConSintomas::class, 'idSintoma');
    }

    public function consulta()
    {
        return $this->belongsTo(Consultas::class, 'idConsulta');
    }

}