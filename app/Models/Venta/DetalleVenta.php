<?php

namespace App\Models\Venta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto\Producto;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $table='venta_detalles';

    protected $fillable =[
        'precio',
        'cantidad',
        'sub_total',
        'producto_id',
        'venta_id',

    ];

    public function relacionProducto(){
        
        return $this->hasOne(Producto::class,'id','producto_id');

    }

    public function realacionNotaVenta(){

        return $this->hasOne(Venta::class,'id','venta_id');

    }


}
