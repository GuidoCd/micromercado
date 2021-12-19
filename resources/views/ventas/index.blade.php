@extends('adminlte::page')

@section('title', 'Micromercado | Nota Venta')

@section('content')

    <div class='row'>
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        <div class="card-title">
                               Opciones de busqueda
                        </div>
                       
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>

    </div>
    <div class="row">
        <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        <div class=" card-title">
                            Listado de Ventas
                        </div>
                        <div class="pull-right">
                            <a href="{{route('ventas.create')}}">
                                <span class="btn btn-sm btn-success float-right">
                                     <i class="fa fa-plus"></i>
                                     crear
                                </span>
                            </a>
                         </div>
                    </div>
                    <div class="card-body table-responsive table-striped">
                            <table class="table table-hover table-bordered">
                                    <thead>
                                            <tr>
                                                <th>Numero</th>
                                                <th>Fecha Creacion</th>
                                                <th>Cliente</th>
                                                <th>Monto Total</th>
                                                <th>Estado</th>
                                                <th colspan="3">Acciones</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                            |@foreach($ventas as $venta)
                                                    <tr>
                                                        <td>
                                                            {{$venta->id}}
                                                        </td>
                                                        <td>
                                                            {{$venta->fecha_creacion}}
                                                        </td>
                                                        <td>
                                                            @foreach($clientes as $cliente)
                                                                @if($venta->cliente_id == $cliente->nit)
                                                                    {{$cliente->razon_social}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{$venta->monto_total}}
                                                        </td>
                                                        <td class="text-center p-1 {{ $venta->estado_color}}">
                                                            {{$venta->estado_descripcion}}
                                                        </td>
                                                        <td>
                                                             <a href="{{route('ventas.edit',$venta)}}" class="btn btn-sm btn-success">
                                                                <span><i class="fa fa-edit"></i>Editar</span>
                                                            </a>

                                                            <a href="{{route('ventas.show',$venta)}}" class="btn btn-sm btn-primary">
                                                                <span> <i class="fa fa-eye"></i>Mostrar </span>
                                                            </a>

                                                            {{-- <a href="{{route('ventas.destroy')}}" class="btn btn-sm btn-danger">
                                                                <span> <i class="fa fa-trash"></i>Eliminar</span>
                                                                
                                                            </a> --}}


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