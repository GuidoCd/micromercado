@extends('adminlte::page')
@section('title', 'Bitacora | Ver Detalle')
@section('content')
    <div class="row">
            <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                            <div class="card-title">Bitacora</div>
                            <div class="float-right">
                                <a href="{{route('bitacoras.index')}}" class="btn btn-sm btn-info">
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
                                                    <label for="empleado">Usuario:</label>
                                                    <input type="text" name="empleado" id="empleado" class="form-control form-control-sm" value="{{ $bitacora->user != null ? $bitacora->user->name : '' }}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="monto">Accion:</label>
                                                    <input type="text" name="monto" id="monto" class="form-control form-control-sm" value="{{$bitacora->accion_descripcion}}" readonly>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="proveedor">Modulo:</label>
                                                    <input type="text" name="proveedor" id="proveedor" class="form-control form-control-sm" value="{{$bitacora->tabla}}" readonly>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if ($bitacora->accion != $bitacora::TIPO_EDITO)
                                                    <div class="col-md-12">
                                                        @foreach (json_decode($bitacora->objeto) as $i => $value)
                                                            @if ($i != 'id')
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        {{ $i }}
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        {{ $value }}
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @else
                                                @php
                                                    $objetos = explode("__", $bitacora->objeto);
                                                @endphp
                                                    @foreach ($objetos as $objeto)
                                                        <div class="col-md-6">
                                                            @foreach (json_decode($objeto) as $i => $value)
                                                                @if ($i != 'id')
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            {{ $i }}
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            {{ $value }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                        @endforeach
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                    </div>
                                </div>

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