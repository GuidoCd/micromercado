<?php

namespace App\Models\Persona;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table='personas';
    
    protected $fillable = [   
        'ci',
        'nombre',
        'sexo',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'estado',
        'tipo',
        'nit',
    ];

    public function getEstadoDescripcionAttribute(){
        $estados=['HABILITADO','DESHABILITADO'];
        return $estados[$this->estado -1 ];

    }
    public function getEstadoColorAttribute(){
            $colores=['badge bg-success','badge bg-danger'];
            return $colores[$this->estado - 1];

    }

    public function getTipoPersonaAttribute(){
            $tipos=['EMPLEADO','CLIENTE'];
            return $tipos[$this->tipo - 1];
    }

    public function setNombreAttribute($nomb){

        $this->attributes['nombre']=\mb_strtoupper($nomb);

    }
    

}
