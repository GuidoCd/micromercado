<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Producto\Producto;
use App\Models\Categoria\Categoria;
use App\Models\Nacionalidad\Nacionalidad;
use App\Models\Unidad\Unidad;
use App\Models\Bitacora\Bitacora;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categorias = Categoria::get();
        $nacionalidades = Nacionalidad::get();
        $unidades = Unidad::get();
        return view('productos.create',\compact('categorias','nacionalidades','unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $inputs = $request->all();

        $codigo = $this->generarCodigo();
        $inputs['codigo'] = $codigo;
        $producto = Producto::create($inputs);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_CREO,
            'tabla' => 'Producto',
            'objeto' => json_encode($producto),
        ]);
        return redirect()->route('productos.index')->with('success','Producto Creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto){
        return view('productos.show',compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto){
        $categorias = Categoria::get();
        $nacionalidades = Nacionalidad::get();
        $unidades = Unidad::get();
        return view('productos.edit',compact('producto','categorias','nacionalidades','unidades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto){
        $inputs = $request->except(['codigo']);
        $productoAnterior = Producto::find($producto->id);
        $producto->update($inputs);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_EDITO,
            'tabla' => 'Productos',
            'objeto' => json_encode($productoAnterior) . '__' . json_encode($producto),
        ]);
        return redirect()->route('productos.index')->with('success','Producto Actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function generarCodigo(){
        $codigo = "P-";
        $nro = Producto::get()->count() + 1;
        $codigo = $codigo . \str_pad($nro,4,'0',STR_PAD_LEFT);
        return $codigo;
    }
    
}
