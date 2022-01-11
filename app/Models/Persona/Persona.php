<?php

namespace App\Models\Persona;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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
    ];

    const EMPLEADO = 1;
    const CLIENTE = 2;

    const  HABILITADO = 1;
    const  DESHABILITADO = 2;

    public function getEstadoDescripcionAttribute(){
        $estados=['HABILITADO','DESHABILITADO'];
        return $estados[$this->attributes['estado'] -1 ];
    }

    public function getFechaNacimientoAttribute(){
        return Carbon::parse($this->attributes['fecha_nacimiento'])->format('d/m/Y');
    }

    public function getEstadoColorAttribute(){
            $colores=['badge bg-success','badge bg-danger'];
            return $colores[$this->attributes['estado'] - 1];
    }

    public function getTipoPersonaAttribute(){
            $tipos=['EMPLEADO','CLIENTE'];
            return $tipos[$this->attributes['tipo'] - 1];
    }

    public function setNombreAttribute($nomb){
        $this->attributes['nombre']=\mb_strtoupper($nomb);
    }

    public function setDireccionAttribute($direccion){
        $this->attributes['direccion']=\mb_strtoupper($direccion);
    }

}
