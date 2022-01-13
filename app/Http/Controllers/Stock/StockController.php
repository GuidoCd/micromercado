<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Stock\StockExport;
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
                        ->where('estado',Movimiento::ESTADO_REALIZADO)
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
                        ->byFechaVencimiento($request->fecha_vencimiento)
                        ->byStock($request->con_stock)
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

    public function excel($producto_id, $fecha_vencimiento, $con_stock){
        return Excel::download(new StockExport($producto_id, $fecha_vencimiento, $con_stock),'Listado de Stock.xlsx');
    }

}
