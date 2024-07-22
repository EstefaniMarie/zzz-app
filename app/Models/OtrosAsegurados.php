<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtrosAsegurados extends Model
{
    protected $table = 'otrosasegurados';

    use HasFactory;

    protected $fillable = [
        'idPacientes',
    ];

    //Relaciones
    public function historialesClinicos() {
        return $this->hasMany(Historial::class, 'idOtroAsegurado', 'id');
    }

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }

}
