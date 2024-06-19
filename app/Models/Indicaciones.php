<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indicaciones extends Model
{
    protected $table = 'indicaciones';

    use HasFactory;

    protected $fillable = [
        'codigoIndicacion',
        'descripcion',
    ];
}