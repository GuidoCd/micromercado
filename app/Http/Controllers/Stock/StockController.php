<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Producto\Producto;
use App\Models\Movimiento\Movimiento;
use Illuminate\Http\Request;
use DB;

class StockController extends Controller{
    public function index(){
        $stocks = Movimiento::where('padre_id',null)
                        ->select(
                            'producto_id',DB::raw('SUM(saldo) as total'),'fecha_vencimiento'
                        )
                        ->groupBy('producto_id')
                        ->groupBy('fecha_vencimiento')
                        ->get();
        foreach ($stocks as $stock) {
            $producto = Producto::find($stock->producto_id);
            $stock->producto = $producto->codigo . ' ' . $producto->nombre;
            $stock->unidad = $producto->unidad != null ? $producto->unidad->abreviacion : '';
        }
        $productos = Producto::get();
        return view('stock.index',compact('stocks','productos'));
    }

    public function search(Request $request){
        $stocks = Movimiento::where('padre_id',null)
                        ->byProducto($request->producto_id)
                        ->select(
                            'producto_id',DB::raw('SUM(saldo) as total')
                        )
                        ->groupBy('producto_id')
                        ->get();
        foreach ($stocks as $stock) {
            $producto = Producto::find($stock->producto_id);
            $stock->producto = $producto->codigo . ' ' . $producto->nombre;
            $stock->unidad = $producto->unidad != null ? $producto->unidad->abreviacion : '';
        }
        $productos = Producto::get();
        return view('stock.index',compact('stocks','productos'));
    }

}
