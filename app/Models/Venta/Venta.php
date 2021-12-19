<?php

namespace App\Models\Venta;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona\Persona;
use App\Models\User;
use Carbon\Carbon;
class Venta extends Model
{
    use HasFactory;
    
    protected $table='ventas';

    protected $fillable = [
        'monto_total',
        'estado', 
        'cliente_id',
        'user_id',

    ];

    public function ralacionCliente(){
        return $this->hasOne(Persona::class,'id','cliente_id');

    }

   

    public function getFechaCreacionAttribute(){

        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');

    }

    public function getEstadoDescripcionAttribute(){
        $descripcion = ['REALIZADA','ANULADA'];
        return $descripcion[$this->attributes['estado'] - 1];
    }

    public function getEstadoColorAttribute(){
        $color = ['badge bg-success','badge bg-danger'];
        return $color[$this->attributes['estado'] - 1];

    }
    

}
