<?php

namespace App\Models\Nota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota\Nota;

class NotaDetalles extends Model
{
    use HasFactory;

    protected $table = 'nota_detalles';
    
    protected $fillable = [
        'producto_id',
        'precio',
        'cantidad',
        'estado',
        'nota_id'

    ];

    public function nota(){

        return $this->hasOne(Nota::class,'id','nota_id');

    }
}