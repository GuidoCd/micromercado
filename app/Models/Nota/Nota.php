<?php

namespace App\Models\Nota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nota extends Model
{
    use HasFactory;

    protected  $table = 'notas';

    protected $fillable = [
        'empleado_id',
        'codigo',
        'tipo_movimiento',
        'monto_total',
        'descripcion',
        'estado',
    ];

    const TIPO_MOV_INGRESO = 1;
    const TIPO_MOV_SALIDA = 2;

    const PENDIENTE = 1;
    const CONCLUIDA = 2;
    const ANULADA = 3;

    public function getFechaFormateadaAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function getTipoMovimientoDescripcionAttribute()
    {
        $tipoMovimientoDescripcion = "N/A";
        if ($this->tipo_movimiento == Nota::TIPO_MOV_INGRESO) {
            $tipoMovimientoDescripcion = "INGRESO";
        } else if ($this->tipo_movimiento == Nota::TIPO_MOV_SALIDA) {
            $tipoMovimientoDescripcion = "SALIDA";
        }
        return $tipoMovimientoDescripcion;
    }

    public function getTipoMovimientoIconoAttribute()
    {
        $tipoMovimientoIcono = "N/A";
        if ($this->tipo_movimiento == Nota::TIPO_MOV_INGRESO) {
            $tipoMovimientoIcono = "fa fa-arrow-circle-up";
        } else if ($this->tipo_movimiento == Nota::TIPO_MOV_SALIDA) {
            $tipoMovimientoIcono = "fa fa-arrow-circle-down";
        }
        return $tipoMovimientoIcono;
    }

    public function getTipoMovimientoColorAttribute()
    {
        $tipoMovimientoColor = "N/A";
        if ($this->tipo_movimiento == Nota::TIPO_MOV_INGRESO) {
            $tipoMovimientoColor = " badge bg-success";
        } else if ($this->tipo_movimiento == Nota::TIPO_MOV_SALIDA) {
            $tipoMovimientoColor = "badge bg-danger";
        }
        return $tipoMovimientoColor;
    }

    public function getEstadoDescripcionAttribute()
    {
        $descripcion = "N/A";
        if ($this->estado == Nota::PENDIENTE) {
            $descripcion = "PENDIENTE";
        } else if ($this->estado == Nota::CONCLUIDA) {
            $descripcion = "CONCLUIDA";
        }else if($this->estado == Nota::ANULADA){
            $descripcion = "ANULADA";
        }
        return $descripcion;
    }

    public function getEstadoColorAttribute()
    {
        $statusColor = "";
        if ($this->estado == Nota::PENDIENTE) {
            $statusColor = "badge bg-secondary";
        } else if ($this->estado == Nota::CONCLUIDA) {
            $statusColor = "badge bg-success";
        }else if($this->estado == Nota::ANULADA){
            $statusColor = "badge bg-danger";
        }
        return $statusColor;
    }
}
