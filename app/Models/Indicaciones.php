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

    public function recipes()
    {
        return $this->belongsToMany(Recipes::class, 'Recipes', 'idIndicacion', 'idTratamiento');
    }
}