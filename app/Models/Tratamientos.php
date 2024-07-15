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
        'tipo'
    ];
    public function diagnosticos()
    {
        return $this->belongsToMany(Consultas::class, 'Diagnosticos_has_Tratamientos', 'idDiagnostico', 'idTratamiento');
    }

    public function indicaciones()
    {
        return $this->belongsToMany(Indicaciones::class, 'Recipes', 'idTratamiento', 'idIndicacion');
    }

    public function diagnosticoshasTratamiento()
    {
        return $this->belongsToMany(Diagnosticos::class, 'Diagnosticos_has_Tratamientos', 'idTratamiento', 'idDiagnostico');
    }
}
