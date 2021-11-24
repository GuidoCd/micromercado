@extends('adminlte::page')

@section('title', 'Micromercado | Productos')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header">
                    Detalles del Producto {{ $producto->codigo }}
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombre">Nombre: </label>
                        <input type="text" readonly class="form-control form-control-sm" value="{{ $producto->nombre }}">
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