<?php

namespace App\Models\Bitacora;

use App\Models\User;
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

    const TIPO_EDITO = 1;
    const TIPO_CREO = 2;
    const TIPO_ELIMINO_ANULO = 3;
    const TIPO_INGRESO = 4;
    const TIPO_SALIO = 5;

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function getAccionColorAttribute(){
        $colores = ['badge bg-success','badge bg-info','badge bg-danger','badge bg-info','badge bg-danger'];
        return $colores[$this->attributes['accion'] - 1];

    }

    public function getAccionDescripcionAttribute(){
        $descripcion = ['EDITO','CREO','ELIMINO','INGRESO','SALIDA'];

        return $descripcion[$this->attributes['accion']-1];

    }
    public function getFechaFormateadaAttribute(){

        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i');
    }
}
