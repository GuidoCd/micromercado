<?php

namespace App\Models\Nota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota\Nota;
use App\Models\Producto\Producto;

class NotaDetalle extends Model
{
    use HasFactory;

    protected $table = 'nota_detalles';
    
    protected $fillable = [
        'producto_id',
        'precio',
        'cantidad',
        'fecha_vencimiento',
        'nota_id'
    ];

    public function nota(){
        return $this->hasOne(Nota::class,'id','nota_id');
    }

    public function producto(){
        return $this->hasOne(Producto::class,'id','producto_id');
    }
}
