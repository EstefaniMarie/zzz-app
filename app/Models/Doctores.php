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
}