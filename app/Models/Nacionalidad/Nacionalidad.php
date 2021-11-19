<?php

namespace App\Models\Nacionalidad;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    use HasFactory;

    protected $table = "nacionalidades";

    protected $fillable = [
        'nombre',
        'estado',
    ];

    public function getEstadoDescripcionAttribute(){
        $estados = ['HABILITADO','INHABILITADO'];
        return $estados[$this->attributes['estado'] - 1];
    } 

    public function setNombreAttribute($value){

        if($value != null)
            $this->attributes['nombre'] = \mb_strtoupper($value);

    }
    
}
