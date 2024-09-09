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

    public function sintomas()
    {
        return $this->belongsToMany(Sintomas::class, 'Sintomas_has_Diagnosticos', 'idSintoma', 'idDiagnostico');
    }

    public function tratamientos()
    {
        return $this->belongsToMany(Tratamientos::class, 'Diagnosticos_has_Tratamientos', 'idDiagnostico', 'idTratamiento');
    }

    public function sintomaConDiagnostico()
    {
        return $this->hasMany(SintomaConDiagnostico::class, 'idDiagnostico');
    }
}
