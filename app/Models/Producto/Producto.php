<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categoria\Categoria;
use App\Models\Nacionalidad\Nacionalidad;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'codigo',
        'nombre',
        'costo',
        'precio',
        'fecha_vencimiento',
        'categoria_id',
        'nacionalidad_id'
    ];



    public function categoria(){
        return $this->hasOne(Categoria::class,'id','categoria_id');
    }

    public function nacionalidad(){
        return $this->hasOne(Nacionalidad::class,'id','nacionalidad_id');
    }
    
}
