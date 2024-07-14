<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indicaciones extends Model
{
    protected $table = 'indicaciones';

    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion',
    ];

    public function tratamientos()
    {
        return $this->belongsToMany(Tratamientos::class, 'Recipes', 'idIndicacion', 'idTratamiento');
    }
}