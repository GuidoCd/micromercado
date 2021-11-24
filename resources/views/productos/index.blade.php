@extends('adminlte::page')

@section('title', 'Micromercado | Productos')

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
                        Listado de Productos
                    </div>
                    <div class="pull-right">
                        <a href="{{ route('productos.create') }}"><span class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Crear</span></a>
                    </div>
                </div>
                <div class="card-body table-responsive table-striped">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Nacionalidad</th>
                                <th>Precio</th>
                                <th colspan="1">Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td class="text-justify p-1">
                                        {{ $producto->codigo }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $producto->nombre }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $producto->categoria != null ? $producto->categoria->nombre : 'N/A' }}
                                    </td>
                                    <td class="text-justify p-1">
                                        {{ $producto->nacionalidad->nombre != null ? $producto->nacionalidad->nombre : 'N/A' }}
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{ route('productos.show',$producto->id) }}" class="btn btn-sm btn-info">
                                            <span>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            &nbsp;
                                            Ver
                                        </a>
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{ route('productos.edit',$producto->id) }}" class="btn btn-sm btn-success">
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
                    {{ $productos->appends(Request::all())->links() }}
                    <p class="text-muted">Mostrando <strong>{{ $productos->count() }}</strong> registros de <strong>{{ $productos->total() }}</strong> totales</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop