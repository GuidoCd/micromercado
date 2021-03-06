@extends('adminlte::page')

@section('title', 'Micromercado |Detalle De Venta')

@section('content')

    <div class="row">
            <div class="col-md-12">
                    <div class="card card-custom">
                            <div class="card-header bg-secondary">
                                <div class="card-title">NOTA DE VENTAS</div>
                                <div class="pull-right">
                                    <a href="{{route('ventas.index')}} " class="btn btn-primary float-right">
                                        <span>
                                            <i class="fa fa-reply"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">

                                   <div class="card card-custom">
                                        <div class="card-header bg-secondary">
                                                <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="nombre_cliente">Cliente</label>
                                                                <input type="text" name="cliente" id="cliente" value="{{$cliente->razon_social}}" readonly class="form-control form-control-sm">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="Nro Venta">Nro venta_:</label>
                                                                <input type="text" name="nro_venta" id="nro_venta" value="{{$venta->id}}" readonly class="form-control form-control-sm">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="monto_total">Monto Total:</label>
                                                                <input type="text" name="monto_total" id="monto_total" value="{{$venta->monto_total}}" readonly class="form-control form-control-sm">

                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="monto_total">Nit:</label>
                                                                <input type="text" name="nit" id="nit" value="{{$cliente->nit}}" readonly class="form-control form-control-sm">

                                                            </div>
                                                       
                                                </div>
                                        </div>

                                   </div>
                            </div>
                    </div>
        <div class="card card-custom">
                    <div class="card-header">
                        Detalles:
                    </div>
                <div class=" card-body table-responsive table-striped">
                    
                        <table class="table table-hover table-bordered">
                            <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Importe</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    @foreach($detalles as $detalle)

                                        <tr>
                                            <td>
                                                @foreach($productos as $producto)
                                                        @if($producto->id == $detalle->producto_id)
                                                         {{$producto->nombre}}
                                                        @endif
                                                @endforeach
                                               
                                            </td>
                                            <td>{{$detalle->cantidad}}</td>
                                            <td>{{$detalle->precio}}</td>
                                            <td> {{$detalle->sub_total}}</td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

 

    

@stop

@section('css')
    
@stop

@section('js')
    
@stop