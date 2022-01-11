@extends('adminlte::page')

@section('title', 'Listado de Stock')

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card card-custom">
                        <div class="card-header bg-secondary">
                            Opciones de Busqueda
                        </div>
                        <div class="card-body">
                            @include('stock.partials.search')
                        </div>
                </div>
        </div>
    </div>
    <div class="col-md-12">
            <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        <div class="card-title">
                            Lista de Stock
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                         <table class=" table table-striped table-hover table-bordered">
                                <thead>
                                        <tr>
                                            <th class="text-center">Producto</th>
                                            <th class="text-center">Fecha Vencimiento</th>
                                            <th class="text-center">Unidad</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        @foreach($stocks  as $stock)
                                            <tr>
                                                <td class="text-justify p-1">
                                                    {{ $stock->producto }}
                                               </td>
                                                <td class="text-justify p-1">
                                                    {{ \Carbon\Carbon::parse($stock->fecha_vencimiento)->format('d/m/Y') }}
                                                </td>
                                                <td class="text-justify p-1">
                                                    {{ $stock->unidad }}
                                                </td>
                                                <td class="text-justify p-1">
                                                    {{ number_format($stock->total,2,'.',',') }}
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
    <script>
    </script>
@stop