@extends('adminlte::page')

@section('title', 'Detalles | Notas de Movimiento')

@section('content')
 <div class="row">
        <div class="col-md-12">
                <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        <div class="card-title">Nota de {{ $nota->tipo_movimiento_descripcion }}</div>
                        <div class="float-right">
                            @can('notas.concluir')
                                @if ($nota->estado == $nota::PENDIENTE)
                                    <button type="button" class="btn btn-sm btn-success" onclick="concluir({{ $nota->id }})">
                                        <span>
                                            <i class="fa fa-check"></i>
                                        </span>
                                        &nbsp;
                                        Concluir
                                    </button>
                                @endif
                            @endcan
                            @can('notas.anular')
                                @if ($nota->estado == $nota::PENDIENTE || $nota->estado == $nota::CONCLUIDA)
                                    <button type="button" class="btn btn-sm btn-danger" onclick="anular({{ $nota->id }})">
                                        <span>
                                            <i class="fa fa-times"></i>
                                        </span>
                                        &nbsp;
                                        Anular
                                    </button>
                                @endif
                            @endcan
                            <a href="{{ route('notas.index') }}" class="btn btn-sm btn-info">
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
                                        <input type="text" name="empleado" id="empleado" class="form-control form-control-sm" value="{{ $usuario->name }}" readonly >
                                    </div>

                                    <div class="col-md-4">
                                        <label for="monto_total">Monto Total:</label>
                                        <input type="text" name="monto_total" id="monto_total" class="form-control form-control-sm" value="{{ $nota->monto_total }}" readonly >
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <label for="descripcion">Descripcion:</label>
                                            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-sm" value="{{ $nota->descripcion }}"readonly >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="descripcion">Estado:</label> <br>
                                        <span class="{{ $nota->estado_color }}">
                                            {{ $nota->estado_descripcion }}
                                        </span>
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
                                            <th>Fecha Vencimiento</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                        </tr>
                                </thead>
                                <tbody>
                                     @foreach($detalles as $detalle)
                                        <tr>
                                            <td>    
                                                {{ $detalle->producto != null ? $detalle->producto->codigo_nombre : '' }}
                                            </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($detalle->fecha_vencimiento)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                {{ number_format($detalle->cantidad,2,'.',',') }}
                                            </td>
                                            <td>
                                                {{ number_format($detalle->precio,2,'.',',') }}
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
        function concluir(id){
            var route = "{{ route('notas.concluir', ':id') }}";
            route = route.replace(':id',id)
            Swal.fire({
                title: '¿Esta seguro que quiere concluir la Nota actual?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Concluir!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = route;
                }
            })
        }

        function anular(id){
            var route = "{{ route('notas.anular', ':id') }}";
            route = route.replace(':id',id)
            Swal.fire({
                title: '¿Esta seguro que quiere anular la Nota actual?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Anular!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = route;
                }
            })
        }

        $(document).ready(function(){

        });
    </script>
@stop