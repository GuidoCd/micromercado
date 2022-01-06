<?php

namespace App\Http\Controllers\Nota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nota\Nota;
use App\Models\User;
use App\Models\Unidad\Unidad;
use App\Models\Producto\Producto;
use App\Models\Nota\NotaDetalle;
use App\Models\Bitacora\Bitacora;
use Carbon\Carbon;



class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $notas = Nota::paginate(20);
        $usuarios = User::get();
        return view('notas.index',compact('notas','usuarios'));
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
        $codigo = $this->generarCodigo($inputs['tipo_movimiento']);
        $nota = Nota::create([
            'empleado_id' => auth()->user()->id,
            'codigo' => $codigo,
            'tipo_movimiento' => $inputs['tipo_movimiento'],
            'descripcion' => $inputs['descripcion'],
            'monto_total' => 0,
            'estado' => Nota::PENDIENTE
        ]);

        $productos_id = $inputs['productos_id'];
        $cantidades = $inputs['cantidades'];
        $precios = $inputs['precios'];

        $total = 0;
        for($i = 0; $i < count($productos_id) ; $i++){
            $cantidad = $cantidades[$i];
            $precio = $precios[$i];
            $sub_total = $precio * $cantidad;
            $total += $sub_total;

            $detalle = NotaDetalle::create([
                'producto_id' => $productos_id[$i],
                'precio' => $precio,
                'cantidad' => $cantidad,
                'nota_id' => $nota->id,
            ]);
        }
        $nota->update([
           'monto_total' => $total,
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

    private function generarCodigo($tipo_movimiento){
        $fecha = Carbon::now();
        $notas = Nota::whereYear('created_at', $fecha->year)
                            ->where('tipo_movimiento',$tipo_movimiento)
                            ->get();

        $nro = count($notas) + 1;
        $codigo = '';
        if($tipo_movimiento == Nota::TIPO_MOV_INGRESO){
            $codigo = 'NI-';
        }else if($tipo_movimiento == Nota::TIPO_MOV_SALIDA){
            $codigo = 'NS-';
        }
        $codigo .= $fecha->year . '-' . str_pad($nro, 6, '0', STR_PAD_LEFT);
        return $codigo;
    }
}
