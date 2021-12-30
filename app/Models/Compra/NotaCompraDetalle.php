<?php

namespace App\Models\Compra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Producto\Producto;

class NotaCompraDetalle extends Model
{
    use HasFactory;
    protected $table='detalle_compras';
    
    protected $fillable = [   
        'precio',
        'cantidad',
        'sub_total',
        'producto_id',
        'nota_compras_id',
    ];

    public function nota_compra(){
        return $this->hasOne(NotaCompra::class,'id','nota_compra_id');
    }

    public function producto(){
        return $this->hasOne(Producto::class,'id','producto_id');
    }
}
