<?php

namespace App\Http\Controllers\Nota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nota\Nota;
use App\Models\User;
use App\Models\Unidad\Unidad;
use App\Models\Producto\Producto;
use App\Models\Nota\NotaDetalles;
use App\Models\Bitacora\Bitacora;



class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bajas = Nota::get();
        $usuarios = User:: get();
        return view('notas.index',compact('bajas','usuarios'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::get();
        $unidades = Unidad::get();
        return view('notas.create',compact('productos','unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(auth()->user()->id);
        //dd($request->all());
        $inputs = $request->all();
        $baja = Nota::create([
            'empleado_id' => auth()->user()->id,
            'monto_total' => $inputs['total'],
            'descripcion' => $inputs['descripcion'],
        ]);

        $productos_id = $inputs['productos_id'];
        $cantidades = $inputs['cantidades'];

        $total = 0;
        for($i = 0; $i < count($productos_id) ; $i++){

            $producto = Producto::find($productos_id[$i]);
            $precio = $producto->precio;
            $cantidad = $cantidades[$i];
            $sub_total = $precio * $cantidad;
            $total += $sub_total;

            $detalle = NotaDetalles::create([
                'producto_id' => $productos_id[$i],
                'precio' => $precio,
                'cantidad' => $cantidad,
                'nota_id' => $baja->id,

            ]);


        }
        $baja->update([
           'sub_total' => $total,
        ]);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => 2,
            'tabla' => 'notas-bajas',
            'objeto' => 'AA',
    
           ]);
        return redirect()->route('notas.index')->with('success','baja creada exitosamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Nota $baja)
    {
        $detalles = NotaDetalles::where('nota_id',$baja->id)->get();  
        $usuario = User::where('id',$baja->empleado_id)->first();
        $productos = Producto::get();
        return view('notas.show',compact('detalles','usuario','baja','productos'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
