@extends('adminlte::page')
@section('title', 'Micromercado | Nota Compra')
@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                            <div class="card-title">Nota de Compra</div>
                            <div class="float-right">
                                @can('compras.concluir')
                                    @if ($compra->estado == $compra::PENDIENTE)
                                        <button type="button" class="btn btn-sm btn-success" onclick="concluir({{ $compra->id }})">
                                            <span>
                                                <i class="fa fa-check"></i>
                                            </span>
                                            &nbsp;
                                            Concluir
                                        </button>
                                    @endif
                                @endcan
                                <a href="{{route('compras.index')}}" class="btn btn-sm btn-info">
                                    <span>
                                        <i class="fa fa-reply"></i>
                                    </span>
                                </a>
                            </div>
                    </div> 
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-custom">
                                    <div class="card-header bg-secondary">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="empleado">Empleado:</label>
                                                    <input type="text" name="empleado" id="empleado" class="form-control form-control-sm" value="{{ $usuario != null ? $usuario->name : '' }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="monto">Monto:</label>
                                                    <input type="text" name="monto" id="monto" class="form-control form-control-sm" value="{{$compra->monto_total}}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="proveedor">Proveedor:</label>
                                                    <input type="text" name="proveedor" id="proveedor" class="form-control form-control-sm" value="{{$proveedor->nombre}}" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="concepto">Concepto:</label>
                                                    <input type="text" name="concepto" id="concepto" class="form-control form-control-sm" value="{{$compra->concepto}}" readonly>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card card-custom">
                    <div class="card-header">
                        <div class="card-title">Detalles:</div>
                     </div>
                        <div class="card-body table-responsive table-striped">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Fecha Vencimiento</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>  
                                <tbody>
                                        @foreach($detalles as $detalle)
                                            <tr>
                                                <td>                                             
                                                    @foreach ($productos as $producto)
                                                        @if($detalle->producto_id == $producto->id)
                                                            {{$producto->nombre}}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($detalle->fecha_vencimiento)->format('d/m/Y') }}
                                                </td>
                                                <td>
                                                    {{$detalle->cantidad}}
                                                </td>
                                                <td>
                                                    {{$detalle->precio}}
                                                </td>
                                                <td>
                                                    {{$detalle->sub_total}}
                                                </td>

                                            </tr>

                                        @endforeach
                                </tbody> 

                            </table>

                        </div>


                </div>
            </div>
            


            
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop