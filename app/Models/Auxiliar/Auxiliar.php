<?php

namespace App\Models\Auxiliar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Auxiliar extends Model
{
    use HasFactory;
    protected $table='auxiliares';
    
    protected $fillable = [   
        'nit',
        'razon_social',
        'persona_id',
    ];

    public function setRazonSocialAttribute($razon_social){

        $this->attributes['razon_social']=\mb_strtoupper($razon_social);

    }
    

}
