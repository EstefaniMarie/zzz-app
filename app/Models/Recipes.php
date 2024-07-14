<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;

    protected $table = 'Recipes';

    protected $fillable = [
        'idIndicacion',
        'idTratamiento'
    ];

    public function tratamiento()
    {
        return $this->belongsTo(Tratamientos::class, 'idTratamiento');
    }

    public function indicaciones()
    {
        return $this->belongsToMany(Indicaciones::class, 'Recipes', 'idTratamiento', 'idIndicacion');
    }
}
