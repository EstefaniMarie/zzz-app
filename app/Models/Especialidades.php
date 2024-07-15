<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Especialidades extends Model
{
    protected $table = 'especialidades';

    use HasFactory;

    protected $fillable = [
        'codigoEspecialidad',
        'descripcion',
    ];

    public function medicos()
    {
        return $this->belongsToMany(Medicos::class, 'medicos_has_especialidades', 'idEspecialidad', 'idMedico');
    }
}