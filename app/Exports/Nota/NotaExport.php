<?php

namespace App\Exports\Nota;

use App\Models\Nota\Nota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use DB;

class NotaExport implements FromView,ShouldAutoSize
{
    use Exportable;

    public function __construct($tipo_movimiento, $codigo, $estado)
    {
        $this->tipo_movimiento = $tipo_movimiento;
        $this->codigo = $codigo;
        $this->estado = $estado;
    }
    
    public function view(): view{
        if($this->tipo_movimiento == -1){
            $this->tipo_movimiento = "";
        }
        if($this->codigo == -1){
            $this->codigo = "";
        }
        if($this->estado == -1){
            $this->estado = "";
        }
        $notas = Nota::byCodigo($this->codigo)->byTipoMovimiento($this->tipo_movimiento)->byEstado($this->estado)->orderBy('id','DESC')->paginate(20);
        return view('notas.excel',['notas' => $notas]);
    }
}
