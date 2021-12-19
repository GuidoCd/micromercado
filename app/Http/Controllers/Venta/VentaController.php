<?php

namespace App\Http\Controllers\Venta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venta\Venta;
use App\Models\Persona\Persona;
use App\Models\Producto\Producto;
use App\Models\Auxiliar\Auxiliar;
use App\Models\Venta\DetalleVenta;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $ventas =  Venta::get();
        $clientes= Auxiliar::get();
        return view('ventas.index',compact('ventas','clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $clientes=Persona::where('tipo','2')->get();
        $productos=Producto::get();
        $auxiliares=Auxiliar::get();
        return view('ventas.create',compact('clientes','productos','auxiliares'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $input = $request->all();
        $product_id = $input['product_id'];
        $cantidad = $input['cantidad'];
        
      
        $venta = Venta::create();
        $venta->update([
            'monto_total' => $input['total'],
            'cliente_id' => $input['nit'],
            'user_id' => $input['razon_social'],

        ]);
         for($i = 0; $i < count($product_id) ; $i++){
             $producto = Producto::find($product_id[$i]);
                     $detalle = [
                    
                    'precio' => $producto->precio,
                    'cantidad' => $cantidad [$i],
                    'sub_total' => $producto->precio * $cantidad[$i],
                    'producto_id' => $product_id [$i],
                    'venta_id' => $venta->id,
                 ];
                
                $nuevo = DetalleVenta::create($detalle);
        }
        return redirect()->route('ventas.index')->with('success','venta creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta){
        $detalles = DetalleVenta::where('venta_id',$venta->id)->get();
        $cliente = Auxiliar::where('nit',$venta->cliente_id)->first();
        //dd($cliente);
        $productos = Producto::get();
        return view('ventas.show',compact('venta','detalles','cliente','productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta){
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Venta $venta){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        
    }
}
