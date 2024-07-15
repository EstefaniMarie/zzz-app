<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personas extends Model
{
    protected $table = 'personas';

    use HasFactory;

    protected $fillable = [
        'image',
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'numero_telefono',
        'idGenero',
        'cedula'
    ];

    public function personas() {
        return $this->hasMany(Personas::class, 'idPersona', 'id');
    }
    public function empleados() {
        return $this->hasMany(Empleados::class, 'idPersona', 'id');
    }

    public function otrosAsegurados() {
        return $this->hasMany(OtrosAsegurados::class, 'idPersona', 'id');
    }

    public function antecedentesFamiliares() {
        return $this->hasMany(Familiares::class, 'idPersona', 'id');
    }

    public function antecedentesPersonales() {
        return $this->hasMany(Personales::class, 'idPersona', 'id');
    }

    public function usuarios() {
        return $this->hasMany(User::class, 'idPersona', 'id');
    }

    public function consultas()
    {
        return $this->hasManyThrough(Consultas::class, Citas::class, 'cedulaPaciente', 'idCita', 'cedula', 'id');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'idGenero');
    }

    public function paciente()
    {
        return $this->hasOne(Pacientes::class, 'idPersona', 'id');
    }
    public function citas()
    {
        return $this->hasMany(Citas::class, 'cedulaPaciente', 'cedula');
    }
    public function tratamientos()
    {
        return $this->hasMany(Tratamientos::class, 'idPersona', 'id');
    }

    public function citasMedico()
    {
        return $this->hasMany(Citas::class, 'cedulaDoctor', 'cedula');
    }
}
