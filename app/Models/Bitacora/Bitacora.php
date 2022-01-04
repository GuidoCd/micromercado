<?php

namespace App\Models\Bitacora;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacoras';

    protected $fillable = [
        'user_id',
        'accion',
        'tabla',
        'objeto',
    ];

    public function getAccionColorAttribute(){
        $colores = ['badge bg-success','badge bg-info','badge bg-danger'];
        return $colores[$this->attributes['accion'] - 1];

    }

    public function getAccionDescripcionAttribute(){
        $descripcion = ['EDITO','CREO','ELIMINO'];

        return $descripcion[$this->attributes['accion']-1];

    }
    public function getFechaFormateadaAttribute(){

        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }
}
