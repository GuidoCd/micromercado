@extends('adminlte::page')

@section('title', 'Micromercado | Nota Compra')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">Opciones de Busqueda</div>
                </div>
                <div class="card-body">
                    {{-- 
                {!! Form::model(Request::all(),[ 'method'=>'GET','route'=>'personal.search','class'=>'row']) !!}
                    @include('recursos-humanos.personal.partials.search') 
                {!! Form::close()!!}
                --}}
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Listado de Compras
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('compras.create') }}"><span class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Crear</span></a>
                    </div>
                </div>
                <div class="card-body table-responsive table-striped">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha Creacion</th>
                                <th>Codigo</th>
                                <th>Concepto</th>
                                <th>Monto Total</th>
                                <th>Proveedor</th>
                                <th>Estado</th>
                                <th colspan="2">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compras as $compra)
                                <tr>
                                    <td class="text-justify p-1">
                                        {{ $compra->fecha_creacion_formateada }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $compra->codigo }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $compra->concepto }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ number_format($compra->monto_total,2,'.',',') }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $compra->proveedor != null ? $compra->proveedor->nombre : 'N/A' }}
                                    </td>
                                    <td class="text-center p-1 {{ $compra->estado_color }}">
                                        {{ $compra->estado_descripcion }}
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{ route('compras.show',$compra->id) }}" class="btn btn-sm btn-info">
                                            <span>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            &nbsp;
                                            Ver
                                        </a>
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{ route('compras.edit',$compra->id) }}" class="btn btn-sm btn-success">
                                            <span>
                                                <i class="fa fa-edit"></i>
                                            </span>
                                            &nbsp;
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    {{ $compras->appends(Request::all())->links() }}
                    <p class="text-muted">Mostrando <strong>{{ $compras->count() }}</strong> registros de <strong>{{ $compras->total() }}</strong> totales</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop