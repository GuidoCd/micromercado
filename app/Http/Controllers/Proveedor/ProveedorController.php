<?php

namespace App\Http\Controllers\Proveedor;

use App\Models\Proveedor\Proveedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bitacora\Bitacora;


class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
    
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prov = Proveedor::paginate(10);

        return view('proveedores.index',compact('prov'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $inputs = $request->all();
        $proveedor = Proveedor::create($inputs);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_CREO,
            'tabla' => 'Proveedores',
            'objeto' => json_encode($proveedor),
        ]);
        return redirect()->route('proveedores.index')->with('success','Proveedor Creado con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Proveedor $proveedor)
    {
        return view('proveedores.edit',compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        $inputs = $request->all();
        $proveedor = Proveedor::find($inputs['proveedor_id']);
        $proveedorAnterior = Proveedor::find($inputs['proveedor_id']);
        $proveedor->update($inputs);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_EDITO,
            'tabla' => 'Proveedores',
            'objeto' => json_encode($proveedorAnterior) . '__' . json_encode($proveedor),
        ]);
       return redirect()->route('proveedores.index')->with('success','Proveedor actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function destroy(Request $request){
            $proveedor = Proveedor::find($request['proveedor_id']);
            $proveedor->update([
                'estado' => Proveedor::DESHABILITADO
            ]);
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_ELIMINO_ANULO,
                'tabla' => 'Proveedores',
                'objeto' => json_encode($proveedor),
            ]);
            return redirect()->route('proveedores.index')->with('success','Proveedor elimando correctamente');
    }
}
