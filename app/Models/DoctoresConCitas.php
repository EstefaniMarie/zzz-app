<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctoresConCitas extends Model
{
    protected $table = 'doctores_has_citas';

    use HasFactory;

    protected $fillable = [
        'idDoctor',
        'idCita',
        'disponibilidad'
    ];
}