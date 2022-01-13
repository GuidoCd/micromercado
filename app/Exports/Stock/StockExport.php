<?php

namespace App\Exports\Stock;

use App\Models\Producto\Producto;
use App\Models\Movimiento\Movimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class StockExport implements FromView,ShouldAutoSize
{
    use Exportable;

    public function __construct($producto_id, $fecha_vencimiento, $con_stock)
    {
        $this->producto_id = $producto_id;
        $this->fecha_vencimiento = $fecha_vencimiento;
        $this->con_stock = $con_stock;
    }
    
    public function view(): view{
        if($this->producto_id == -1){
            $this->producto_id = "";
        }
        if($this->fecha_vencimiento == -1){
            $this->fecha_vencimiento = "";
        }
        if($this->con_stock == -1){
            $this->con_stock = "";
        }
        $stocks = Movimiento::where('padre_id',null)
                        ->byProducto($this->producto_id)
                        ->byFechaVencimiento($this->fecha_vencimiento)
                        ->byStock($this->con_stock)
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
        return view('stock.excel',['stocks' => $stocks, 'fecha_vencimiento' => $this->fecha_vencimiento, 'con_stock' => $this->con_stock]);
    }
}
