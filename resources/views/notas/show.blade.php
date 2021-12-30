@extends('adminlte::page')

@section('title', 'Detalles | Bajas')

@section('content')
 <div class="row">
        <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        <div class="card-title">Nota de Baja</div>
                        <div class="pull-right">
                            <a href="{{route('notas.index')}}" class="btn btn-sm btn-info float-right">
                                <span>
                                    <i class="fa fa-reply"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-custom">
                            <div class="card-header bg-secondary">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="empleado">Empleado:</label>
                                        <input type="text" name="empleado" id="empleado" class="form-control form-control-sm" value="{{$usuario->name}}" readonly >
                                    </div>

                                    <div class="col-md-4">
                                        <label for="monto_total">Monto Total:</label>
                                        <input type="text" name="monto_total" id="monto_total" class="form-control form-control-sm" value="{{$baja->monto_total}}" readonly >
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <label for="descripcion">Descripcion:</label>
                                            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-sm" value="{{$baja->descripcion}}"readonly >
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        Detalles:
                    </div>
                    <div class="card-body table-responsive table-striped">
                            <table class="table table-hover table-bordered">
                                <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
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
                                            <td>
                                                {{$detalle->precio}}
                                            </td>
                                            <td>
                                                {{$detalle->cantidad}}
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
    <script>

     
    </script>
@stop