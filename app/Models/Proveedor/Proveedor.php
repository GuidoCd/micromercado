<?php

namespace App\Models\Proveedor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = "proveedores";

    protected $fillable = [
        'nombre',                       // nombre	nombre_empresa	estado	telefono
        'nombre_empresa',
        'estado',
        'telefono'
    ];

    const HABILITADO = 1;
    const DESHABILITADO = 2;

    public function getEstadoDescripcionAttribute(){
        $estados = ['HABILITADO','INHABILITADO'];
        return $estados[$this->attributes['estado'] - 1];
    } 

    public function getEstadoColorAttribute(){
        $estados = ['badge bg-success','badge bg-danger'];
        return $estados[$this->attributes['estado'] - 1];
    }

    public function setNombreAttribute($value){

        if($value != null)
            $this->attributes['nombre'] = \mb_strtoupper($value);

    }
    
}
