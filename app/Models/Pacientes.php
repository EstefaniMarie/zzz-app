<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pacientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPersona'
    ];

    public function personas() {
        return $this->belongsTo(Personas::class, 'idPersona', 'id');
    }
}
