<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticosConTratamientos extends Model
{
    use HasFactory;

    protected $table = 'Diagnosticos_has_Tratamientos';
    protected $fillable = [
        'idDiagnostico',
        'idTratamiento'
    ];

    public function tratamiento()
    {
        return $this->belongsTo(Tratamientos::class, 'idTratamiento');
    }
}
