<?php

namespace App\Http\Controllers\Baja;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Baja\Baja;
use App\Models\User;
use App\Models\Unidad\Unidad;
use App\Models\Producto\Producto;
use App\Models\Baja\DetalleBaja;



class BajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bajas = Baja::get();
        $usuarios = User:: get();
        return view('bajas.index',compact('bajas','usuarios'));

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
        return view('bajas.create',compact('productos','unidades'));
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
        $baja = Baja::create([
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

            $detalle = DetalleBaja::create([
                'producto_id' => $productos_id[$i],
                'precio' => $precio,
                'cantidad' => $cantidad,
                'sub_total' => $sub_total,
                'nota_baja_id' => $baja->id,

            ]);


        }
        $baja->update([
           'sub_total' => $total,
        ]);
        return redirect()->route('bajas.index')->with('success','baja creada exitosamente');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Baja $baja)
    {
        $detalles = DetalleBaja::where('nota_baja_id',$baja->id)->get();  
        $usuario = User::where('id',$baja->empleado_id)->first();
        $productos = Producto::get();
        return view('bajas.show',compact('detalles','usuario','baja','productos'));

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
