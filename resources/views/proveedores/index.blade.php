@extends('adminlte::page')

@section('title', 'Micromercado | Proveedores')

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
                    Listado de Proveedores
                </div>
                <div class="pull-right">
                    <a href="{{ route('proveedores.create') }}"><span class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Crear</span></a>
                </div>
            </div>
            <div class="card-body table-responsive table-striped">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Nombre Empresa</th>
                            <th>Estado</th>
                            <th>Telefono</th>
                            <th colspan="3">Opciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prov as $proveedor)
                            <tr>
                                <td class="text-justify p-1">
                                    {{ $proveedor->id }}
                                </td>
                                <td class="text-justify p-1">
                                    {{ $proveedor->nombre }}
                                </td>
                                <td class="text-center p-1 ">
                                    {{ $proveedor->nombre_empresa }}
                                </td>
                                
                                <td class="text-justify p-1 {{ $proveedor->estado_color }} ">
                                    {{ $proveedor->estado }}
                                </td>

                                <td class="text-center p-1 ">
                                    {{ $proveedor->telefono }}
                                </td>
                               
                                <td class="text-center p-1">
                                    <a href="{{ route('proveedores.edit',$proveedor->id) }}" class="btn btn-sm btn-success">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span>
                                        &nbsp;
                                        Editar
                                    </a>
                                </td>
                                <td class="text-center p-1">
                                    <form action="/proveedores/delete" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="proveedor_id" value="{{ $proveedor->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger" >
                                            <span>
                                                <i class="fa fa-trash"></i>
                                            </span>
                                            &nbsp;
                                            Eliminar
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
             <div class="card-footer clearfix">
                {{ $prov->appends(Request::all())->links() }}
                <p class="text-muted">Mostrando <strong>{{ $prov->count() }}</strong> registros de <strong>{{ $prov->total() }}</strong> totales</p>
            </div> 
        </div>
    </div>
</div>
   
@stop

@section('css')
    
@stop

@section('js')
    
@stop