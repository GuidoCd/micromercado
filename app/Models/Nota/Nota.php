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

    public function getFechaFormateadaAttribute(){

        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');

    }

    

}
