<?php

namespace App\Models\Compra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Proveedor\Proveedor;

use Carbon\Carbon;

class NotaCompra extends Model
{
    use HasFactory;
    protected $table='nota_compras';
    
    protected $fillable = [   
        'codigo',
        'concepto',
        'monto_total',
        'estado',
        'proveedor_id',
        'user_id',
    ];

    const ANULADA = 1;
    const PENDIENTE = 2;
    const APROBADA = 3;

    public function proveedor(){
        return $this->hasOne(Proveedor::class,'id','proveedor_id');
    }

    public function getFechaCreacionFormateadaAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function getEstadoDescripcionAttribute(){
        $estados=['ANULADA','PENDIENTE','APROBADA'];
        return $estados[$this->attributes['estado'] -1];
    }

    public function getEstadoColorAttribute(){
        $colores=['badge bg-danger','badge bg-secondary','badge bg-success'];
        return $colores[$this->attributes['estado'] - 1];
    }

    public function setCodigoAttribute($value){
        if($value)
            $this->attributes['codigo']=\mb_strtoupper($value);
    }

    public function setConceptoAttribute($value){
        if($value)
            $this->attributes['concepto']=\mb_strtoupper($value);
    }
}
