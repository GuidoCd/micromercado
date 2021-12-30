<?php

namespace App\Models\Baja;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Baja extends Model
{
    use HasFactory;

    protected  $table = 'bajas';

    protected $fillable = [
        'empleado_id',
        'monto_total',
        'descripcion',
        'created_at',
        


    ];

    public function getFechaFormateadaAttribute(){

        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');

    }

    

}
