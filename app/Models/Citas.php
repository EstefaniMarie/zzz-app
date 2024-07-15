<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Citas extends Model
{
    protected $table = 'citas';

    use HasFactory;

    protected $fillable = [
        'cedulaPaciente',
        'cedulaMedico'
    ];

    public function paciente()
    {
        return $this->belongsTo(Personas::class, 'cedulaPaciente', 'cedula');
    }

    public function consultas()
    {
        return $this->hasMany(Consultas::class, 'idCita');
    }

    public function persona()
    {
        return $this->belongsTo(Personas::class, 'cedulaPaciente');
    }

    public function medico()
    {
        return $this->belongsTo(Personas::class, 'cedulaDoctor');
    }
}
