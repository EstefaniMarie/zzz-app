<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parentesco extends Model
{
    protected $table = 'parentesco';

    use HasFactory;

    protected $fillable = [
        'descripcion'
    ];
}