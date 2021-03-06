@extends('adminlte::page')

@section('title', 'Micromercado | Bitacoras')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                    <div class="card-header bg-secondary">
                            <div class="title">Opciones de Busqueda</div>
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
                <div class="card-title">Bitacoras</div>
                <div class="pull-right">
                </div>

            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Accion</th>
                            <th class="text-center">Modulo</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($bitacoras as $bitacora)
                                <tr>
                                    <td class="text-center p-1">
                                        @foreach($usuarios as $usuario)
                                            @if($usuario->id == $bitacora->user_id)
                                                {{$usuario->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center p-1">
                                        <span class="{{ $bitacora->accion_color }}">
                                            {{$bitacora->accion_descripcion}}
                                        </span>
                                    </td>
                                    <td class="text-center p-1">
                                        {{$bitacora->tabla}}
                                    </td>
                                   
                                    <td class="text-center p-1">
                                        {{$bitacora->fecha_formateada}}
                                    </td>
                                    <td class="text-center p-1">
                                        <a href="{{route('bitacoras.show',$bitacora)}} " class="btn btn-sm btn-info">
                                            <span>
                                                <i class="fa fa-eye"></i>
                                            </span>
                                            &nbsp;
                                            Ver
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                    </tbody>


            </table>

        </div>
    </div>
    </div>

   
@stop

@section('css')
    
@stop

@section('js')
    
@stop