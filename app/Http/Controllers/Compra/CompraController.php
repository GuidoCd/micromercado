<?php

namespace App\Http\Controllers\Compra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Compra\NotaCompra;
use App\Models\Compra\NotaCompraDetalle;
use App\Models\Producto\Producto;
use App\Models\Proveedor\Proveedor;
use App\Models\User;
use App\Models\Bitacora\Bitacora;

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
        $inputs = $request->all();
        $cantidades = $inputs['cantidades'];
        $fechas_vencimiento = $inputs['fechas_vencimiento'];
        $productos = $inputs['productos_id'];
        $precios = $inputs['precios'];
        $codigo = $this->generarCodigo();
        $total = 0;
        $compra = NotaCompra::create([
            'codigo' => $codigo,
            'proveedor_id' => $inputs['proveedor_id'],
            'user_id' => auth()->user()->id,
            'monto_total' => $total,
            'concepto' => $inputs['concepto'],
        ]);
            for($i = 0 ;$i < count($productos) ; $i++){
                $precio = $precios[$i];
                $cantidad = $cantidades[$i];
                $sub_total = $precios[$i] * $cantidades[$i];
                $total += $sub_total;
                $compraDetalle = NotaCompraDetalle::create([
                    'precio' => $precio,
                    'cantidad' => $cantidad,
                    'sub_total' => $sub_total,
                    'producto_id' => $productos[$i],
                    'fecha_vencimiento' => $fechas_vencimiento[$i],
                    'nota_compras_id' => $compra->id,
                ]);
            

            }
            $compra->update([
                'monto_total' => $total,
            ]);
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_CREO,
                'tabla' => 'Compras',
                'objeto' => json_encode($compra),
            ]);
        return redirect()->route('compras.index')->with('success','Compra registrada con Exito');
        
    }

    private function generarCodigo(){
        $codigo = "C-";
        $nro = NotaCompra::get()->count() + 1;
        $codigo = $codigo . \str_pad($nro,4,'0',STR_PAD_LEFT);
        return $codigo;
    }

    //vista de un recurso en especifico
    public function show(NotaCompra $compra){
        $detalles = NotaCompraDetalle::where('nota_compras_id',$compra->id)->get();
        $proveedor = Proveedor::where('id',$compra->proveedor_id)->first();
        $usuario = User::find($compra->user_id);
        $productos = Producto::get();
       return view('compras.show',compact('compra','detalles','proveedor','usuario','productos'));
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
