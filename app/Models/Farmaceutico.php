<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farmaceutico extends Model
{
    protected $table = 'farmaceutico';

    use HasFactory;

    protected $fillable = [
        'Usuarios_idUsuarios'
    ];
}