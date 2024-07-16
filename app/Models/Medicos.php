<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicos extends Model
{
    protected $table = 'medicos';

    use HasFactory;

    protected $fillable = [
        'idUsuario'
    ];

    public function especialidades()
    {
        return $this->belongsToMany(Especialidades::class, 'medicos_has_especialidades', 'idMedico', 'idEspecialidad');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
