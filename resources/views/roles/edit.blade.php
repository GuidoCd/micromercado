@extends('adminlte::page')

@section('title', 'Usuarios | Editar')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Edicion de Roles
                    </div>
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update',$role)}}" method="post" id="form_edit">
                        @method('PUT')
                        @csrf
                        @include('roles.partials.form')
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success float-right" onclick="guardar();">
                                    <span>
                                        <i class="fa fa-save"></i>
                                    </span>
                                    &nbsp;
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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

            if(!verificarCampo(document.getElementById('guard_name'))){
                sw = false;
            }

            return sw;
        }

        function guardar(){

                $("#form_edit").submit();
            
        }
    </script>
@stop