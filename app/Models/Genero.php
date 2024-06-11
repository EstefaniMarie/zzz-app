<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genero extends Model
{
    protected $table = 'genero';

    use HasFactory;

    protected $fillable = [
        'tipo',
        'descripcion'
    ];
}