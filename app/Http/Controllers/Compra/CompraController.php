<?php

namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Compra\NotaCompra;
use App\Models\Compra\NotaCompraDetalle;
use App\Models\Producto\Producto;
use App\Models\Proveedor\Proveedor;

class CompraController extends Controller
{
    //Listado de los recusos
    public function index(){
        $compras = NotaCompra::paginate(15);
        return view('compras.index',compact('compras'));
    }

    //Formulario de creacion
    public function create(){
        $proveedores = Proveedor::get();
        $productos = Producto::get();
        return view('compras.create',compact('proveedores', 'productos'));
    }

    //guardado del formulario
    public function store(Request $request){
        
    }

    //vista de un recurso en especifico
    public function show( $usuario){
       
    }

    //formulario de act
    public function edit( $usuario){
       
    }

    //actualizacion del recurso
    public function update(Request $request){
       
    }

    //eliminar de recurso
    public function destroy(Request $request){

    }
}
