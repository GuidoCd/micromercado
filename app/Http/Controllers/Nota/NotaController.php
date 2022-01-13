<?php

namespace App\Http\Controllers\Nota;

use App\Exceptions\ValidationException;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Nota\NotaExport;
use Illuminate\Http\Request;
use App\Models\Nota\Nota;
use App\Models\User;
use App\Models\Unidad\Unidad;
use App\Models\Producto\Producto;
use App\Models\Nota\NotaDetalle;
use App\Models\Bitacora\Bitacora;
use App\Models\Movimiento\Movimiento;
use Carbon\Carbon;
use DB;



class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $notas = Nota::orderBy('id','DESC')->paginate(20);
        $usuarios = User::get();
        return view('notas.index',compact('notas','usuarios'));
    }

    public function search(Request $request){
        $notas = Nota::byCodigo($request->codigo)->byTipoMovimiento($request->tipo_movimiento)->byEstado($request->estado)->orderBy('id','DESC')->paginate(20);
        $usuarios = User::get();
        return view('notas.index',compact('notas','usuarios'));
    }

    public function excel($tipo_movimiento,$codigo,$estado){
        return Excel::download(new NotaExport($tipo_movimiento, $codigo, $estado),'Listado de Notas de Movimiento.xlsx');
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
    public function store(Request $request){
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
        $fechas_vencimiento = $inputs['fechas_vencimiento'];
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
                'fecha_vencimiento' => $fechas_vencimiento[$i],
                'nota_id' => $nota->id,
            ]);
        }
        $nota->update([
           'monto_total' => $total,
        ]);
        $bitacora = Bitacora::create([
            'user_id' => auth()->user()->id,
            'accion' => Bitacora::TIPO_CREO,
            'tabla' => 'Producto | Nota Movimiento',
            'objeto' => json_encode($nota),
        ]);
        return redirect()->route('notas.index')->with('success','baja creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Nota $nota){
        $detalles = NotaDetalle::where('nota_id',$nota->id)->get();
        $usuario = User::find($nota->empleado_id);
        return view('notas.show',compact('detalles','usuario','nota'));

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

    public function concluir(Nota $nota){
        try {
            $notaAnterior = Nota::find($nota->id);
            if($nota->estado != Nota::PENDIENTE){
                throw new ValidationException('Acción no autorizada!');
            }
            $detalles = NotaDetalle::where('nota_id',$nota->id)->get();
            if($nota->tipo_movimiento == Nota::TIPO_MOV_SALIDA){
                if(!$this->existeStock($detalles)){
                    throw new ValidationException('No existe stock para concluir el movimiento!');
                }
            }
            $movimientos = $this->registrarMovimientos($nota,$detalles);
            if($movimientos['isOk']){
                $nota->update([
                    'estado' => Nota::CONCLUIDA
                ]);
            }
            $bitacora = Bitacora::create([
                'user_id' => auth()->user()->id,
                'accion' => Bitacora::TIPO_EDITO,
                'tabla' => 'Producto | Notas de Movimiento',
                'objeto' => json_encode($notaAnterior) . '__' . json_encode($nota),
               ]);
            return redirect()->back()->with('success','Nota Concluida con éxito!');
        } catch (ValidationException $th) {
            return redirect()->back()->with('error',$th->getMessage());
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Ups! Ocurrio un error!');
        }
    }

    public function anular(Nota $nota){
        try {
            $detalles = NotaDetalle::where('nota_id',$nota->id)->get();
            if($nota->estado == Nota::CONCLUIDA){
                $anulados = $this->anularMovimientos($nota,$detalles);
                if(!$anulados['isOk']){
                    throw new ValidationException($anulados['mensaje']);
                }
            }
            $nota->update([
                'estado' => Nota::ANULADA
            ]);
            return redirect()->back()->with('success','Nota Anulada con éxito!');
        } catch (ValidationException $th) {
            return redirect()->back()->with('error',$th->getMessage());
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Ups! Ocurrio un error!');
        }
    }

    public function existeStock($detalles){
        $sw = true;
        foreach ($detalles as $detalle){
            $stock = Movimiento::whereNull('padre_id')->where('producto_id',$detalle->producto_id)->where('precio_movimiento',$detalle->precio)->where('fecha_vencimiento',$detalle->fecha_vencimiento)->first();
            if($stock == null || $stock->saldo < $detalle->cantidad){
                $sw = false;
                break;
            }
        }
        return $sw;
    }

    public function anularMovimientos($nota,$detalles){
        try {
            $result = DB::transaction(function () use ($nota,$detalles) {
                $sw = false;
                foreach ($detalles as $detalle){
                    $actual = Movimiento::whereNull('padre_id')->where('nota_id',$nota->id)->where('producto_id',$detalle->producto_id)->where('precio_movimiento',$detalle->precio)->where('fecha_vencimiento',$detalle->fecha_vencimiento)->where('estado',Movimiento::ESTADO_REALIZADO)->first();
                    if($actual == null){
                        throw new ValidationException('No se puede realizar la anulacion, ya que el stock actual ya no cuenta con el mismo saldo!');
                    }
                }
                foreach ($detalles as $detalle){
                    $actual = Movimiento::whereNull('padre_id')->where('nota_id',$nota->id)->where('producto_id',$detalle->producto_id)->where('precio_movimiento',$detalle->precio)->where('fecha_vencimiento',$detalle->fecha_vencimiento)->first();
                    $anterior = Movimiento::where('padre_id',$actual->id)->first();
                    $actual->update([
                        'estado' => Movimiento::ESTADO_ANULADO
                    ]);
                    if($anterior != null){
                        $anterior->update([
                            'padre_id' => null,
                            'estado' => Movimiento::ESTADO_REALIZADO
                        ]);
                    }
                    $sw = true;
                }
                return $sw;
            });
            if($result){
                return [
                    'isOk' => true,
                    'mensaje' => 'Ingresos registrados con éxito!'
                ];
            }else{
                throw new ValidationException('No se registraron ingresos nuevos');
            }
        } catch (ValidationException $th) {
            return [
                'isOk' => false,
                'mensaje' => $th->getMessage()
            ];
        } catch (\Throwable $th) {
            return [
                'isOk' => false,
                'mensaje' => 'Ups! Ocurrico un problema, por favor contactar al área de sistema'
            ];
        }
    }

    public function registrarMovimientos($nota,$detalles){
        try {
            $result = DB::transaction(function () use ($nota,$detalles) {
                $sw = false;
                foreach ($detalles as $detalle){
                    $anterior = Movimiento::whereNull('padre_id')->where('producto_id',$detalle->producto_id)->where('precio_movimiento',$detalle->precio)->where('fecha_vencimiento',$detalle->fecha_vencimiento)->where('estado',Movimiento::ESTADO_REALIZADO)->first();
                    if($anterior != null){
                        if($nota->tipo_movimiento == Nota::TIPO_MOV_INGRESO){
                            $saldo = $anterior->saldo + $detalle->cantidad;
                        }else{
                            $saldo = $anterior->saldo - $detalle->cantidad;
                        }
                        $precio = $anterior->precio_movimiento;
                    }else{
                        $saldo = $detalle->cantidad;
                        $precio = $detalle->precio;
                    }
                    $movimiento = Movimiento::create([
                        'producto_id' => $detalle->producto_id,
                        'nota_id' => $nota->id,
                        'fecha_vencimiento' => $detalle->fecha_vencimiento,
                        'cantidad' => $detalle->cantidad,
                        'precio' => $precio,
                        'precio_movimiento' => $detalle->precio,
                        'saldo' => $saldo,
                        'estado' => Movimiento::ESTADO_REALIZADO,
                    ]);
                    if($anterior != null){
                        $anterior->update([
                            'padre_id' => $movimiento->id
                        ]);
                    }
                    if(!$sw){
                        $sw = true;
                    }
                }
                return $sw;
            });
            if($result){
                return [
                    'isOk' => true,
                    'mensaje' => 'Ingresos registrados con éxito!'
                ];
            }else{
                throw new ValidationException('No se registraron ingresos nuevos');
            }
        } catch (ValidationException $th) {
            return [
                'isOk' => false,
                'mensaje' => $th->getMessage()
            ];
        } catch (\Throwable $th) {
            return [
                'isOk' => false,
                'mensaje' => 'Ups! Ocurrico un problema, por favor contactar al área de sistema'
            ];
        }
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
