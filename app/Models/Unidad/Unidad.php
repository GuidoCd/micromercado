<?php

namespace App\Models\Unidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = "unidades";

    protected $fillable = [
        'nombre',
        'abreviacion',
    ];
    
}
