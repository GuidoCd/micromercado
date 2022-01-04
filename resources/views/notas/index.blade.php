@extends('adminlte::page')

@section('title', 'Usuarios | Creación')

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card card-custom">
                        <div class="card-header bg-secondary">
                            Opciones de Busqueda
                        </div>
                        <div class="card-body">

                        </div>
                </div>
        </div>
    </div>
    <div class="col-md-12">
            <div class="card card-custom">
                    <div class="card-header bg-secondary">
                        <div class="card-title">
                            Lista de Notas
                        </div>           
                        <div class="pull-rigth">
                            <a href="{{route('notas.create')}}" class="btn btn-sm btn-success float-right">
                                <span>
                                    <i class="fa fa-plus"></i>
                                </span>
                                Crear
                                &nbsp;
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                         <table class=" table table-striped table-hover table-bordered">
                                <thead>
                                        <tr>
                                            <th class="text-center">Tipo de Movimiento</th>
                                            <th class="text-center">Empleado</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center"colspan="3">Acciones</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        @foreach($notas  as $nota)
                                            <tr>
                                                <td class="text-justify p-1">
                                                    {{ $nota->tipo_movimiento_descripcion }}
                                                    <span class="{{ $nota->tipo_movimiento_color }}">
                                                        {{ $nota->tipo_movimiento_icono }}
                                                    </span>
                                               </td>
                                                <td class="text-justify p-1">
                                                     @foreach($usuarios as $usuario)
                                                         @if($usuario->id == $nota->empleado_id)
                                                            {{$usuario->name}}
                                                         @endif
                                                     @endforeach
                                                </td>
                                                <td class="text-justify p-1">
                                                     {{$nota->fecha_formateada}}
                                                </td>
                                                <td class="text-justify p-1">
                                                    <span class="{{ $nota->estado_color }}">
                                                        {{ $nota->estado_descripcion }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{route('notas.show',$nota)}}" class="btn btn-sm btn-info">
                                                        <span>
                                                            <i class="fa fa-eye"></i>
                                                        </span>
                                                        &nbsp;
                                                        Ver  
                                                    </a>
                                                    <a href="{{route('notas.edit',$nota)}}" class="btn btn-sm btn-success">
                                                            <span>
                                                                <i class="fa fa-edit"></i>
                                                            </span>
                                                            &nbsp;
                                                            Editar
                                                    </a>
                                                    <a href="{{route('notas.destroy')}}" class="btn btn-sm btn-danger">
                                                        <span>
                                                            <i class="fa fa-trash"></i>
                                                        </span>
                                                        &nbsp;
                                                        Eliminar
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach
                                </tbody>


                         </table>

                    </div>
                    <div class="card-footer clearfix">
                        {{ $notas->appends(Request::all())->links() }}
                        <p class="text-muted">Mostrando <strong>{{ $notas->count() }}</strong> registros de <strong>{{ $notas->total() }}</strong> totales</p>
                    </div>
            </div>

    </div>

@stop

@section('css')

@stop

@section('js')
    <script>

       
        function verificarCampo(input){
            if(input.value == ""){
                $("#" + input.id).removeClass("is-valid");
                $("#" + input.id).addClass("is-invalid");
                return false;
            }else{
                $("#" + input.id).removeClass("is-invalid");
                $("#" + input.id).addClass("is-valid");
                return true;
            }
        }

       

       

        function validateInputs(){
            var sw = true;

            if(!verificarCampo(document.getElementById('name'))){
                sw = false;
            }

            if(!verificarCampo(document.getElementById('email'))){
                sw = false;
            }
            if(!verificarCampo(document.getElementById('password'))){
                sw = false;
            }
            if(!verificarCampo(document.getElementById('password_confirm'))){
                sw = false;
            }
           
            return sw;
        }

        function actualizar(){
            if(validateInputs()){
                $("#form_edit").submit();
            }else{
                toastr.error('Por favor rellene los campos obligatorios.', 'Ups!');
            }
        }
        function verificarPasswordConfirm(inputs){
            return true;

        }
        function verificarPassword(input){
            return true;
        }
    </script>
@stop