<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtrosAsegurados extends Model
{
    protected $table = 'otros_asegurados';

    use HasFactory;

    protected $fillable = [
        'Personas_idPersonas'
    ];
}