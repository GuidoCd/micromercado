<?php

namespace App\Models\Baja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Baja\Baja;

class DetalleBaja extends Model
{
    use HasFactory;

    protected $table = 'baja_detalles';
    
    protected $fillable = [
        'producto_id',
        'precio',
        'cantidad',
        'sub_total',
        'nota_baja_id'




    ];

    public function relacionConBaja(){

        return $this->hasOne(Baja::class,'id','nota_baja_id');

    }
}
