<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultaConDiagnosticos extends Model
{
    use HasFactory;

    protected $table = 'Consultas_has_Diagnosticos';
    protected $fillable = [
        'idConsulta',
        'idDiagnostico'
    ];

    public function diagnostico()
    {
        return $this->belongsTo(Diagnosticos::class, 'idDiagnostico');
    }
}
