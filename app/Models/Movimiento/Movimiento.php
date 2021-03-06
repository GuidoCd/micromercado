<?php

namespace App\Models\Movimiento;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Movimiento extends Model
{
    protected $table = "movimientos";

    protected $fillable = [
        'padre_id',
        'producto_id',
        'nota_id',
        'fecha_vencimiento',
        'cantidad',
        'precio',
        'precio_movimiento',
        'saldo',
        'estado',
    ];

    const ESTADO_REALIZADO = 1;
    const ESTADO_ANULADO = 2;

    public function producto()
    {
        return $this
            ->belongsTo('App\Models\Web\Producto\Producto');
    }

    //Scopes

    public function scopeByProducto($query, $producto_id)
    {
        if ($producto_id) {
            return $query->where('producto_id', $producto_id);
        }
    }

    public function scopeByFechaVencimiento($query, $fecha_vencimiento)
    {
        if ($fecha_vencimiento) {
            return $query->where('fecha_vencimiento','<=', $fecha_vencimiento);
        }
    }

    public function scopeByStock($query, $con_stock)
    {
        if ($con_stock) {
            if($con_stock == "1"){
                return $query->where('saldo','>', '0');
            }else{
                return $query->where('saldo','=', '0');
            }
        }
    }
    /* Atributos Personalizados */


    public function getFormatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function getEstadoDescripcionAttribute()
    {
        $statusDescription = "N/A";
        if ($this->estado == Movimiento::ESTADO_REALIZADO) {
            $statusDescription = "REALIZADO";
        } else if ($this->estado == Movimiento::ESTADO_ANULADO) {
            $statusDescription = "ANULADO";
        }
        return $statusDescription;
    }

    public function getEstadoColorAttribute()
    {
        $statusColor = "N/A";
        if ($this->estado == Movimiento::ESTADO_REALIZADO) {
            $statusColor = "badge bg-success";
        } else if ($this->estado == Movimiento::ESTADO_ANULADO) {
            $statusColor = "badge bg-danger";
        }
        return $statusColor;
    }
}
