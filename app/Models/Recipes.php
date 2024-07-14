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

    public function indicacion()
    {
        return $this->belongsTo(Indicaciones::class, 'idIndicacion');
    }

}
