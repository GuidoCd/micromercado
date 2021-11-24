@extends('adminlte::page')

@section('title', 'Micromercado | Categorias')

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
                    Listado de Categorias
                </div>
                <div class="pull-right">
                    <a href="{{ route('categorias.create') }}"><span class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Crear</span></a>
                </div>
            </div>
            <div class="card-body table-responsive table-striped">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th colspan="1">Opciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                               
                                <td class="text-justify p-1">
                                    {{ $categoria->nombre }}
                                </td>
                                <td class="text-center p-1">
                                    <a href="{{ route('categorias.edit',$categoria) }}" class="btn btn-sm btn-success">
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
                {{ $categorias->appends(Request::all())->links() }}
                <p class="text-muted">Mostrando <strong>{{ $categorias->count() }}</strong> registros de <strong>{{ $categorias->total() }}</strong> totales</p>
            </div> 
        </div>
    </div>
</div>
   
@stop

@section('css')
    
@stop

@section('js')
    
@stop