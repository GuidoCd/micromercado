@extends('adminlte::page')

@section('title', 'Usuarios | Creación')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Creacion de Roles
                    </div>
                    <a href="{{ route('permisos.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('permisos.store') }}" method="post" id="form_create">
                        @csrf
                        @include('permisos.partials.form')
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success float-right" onclick="guardar()">
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

        function verificarPassword(){
            var password = $("#password");
            if(password.val()  == ""){
                password.removeClass("is-valid");
                password.addClass("is-invalid");
                return false;
            }else{
                password.removeClass("is-invalid");
                password.addClass("is-valid");
                return true;
            }
        }

        function verificarPasswordConfirm(){
            var password = $("#password");
            var password_confirm = $("#password_confirm");
            if(password.val() == "" || password.val() != password_confirm.val()){
                password_confirm.removeClass("is-valid");
                password_confirm.addClass("is-invalid");
                return false;
            }else{
                password_confirm.removeClass("is-invalid");
                password_confirm.addClass("is-valid");
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

            if(!verificarPassword()){
                sw = false;
            }

            if(!verificarPasswordConfirm()){
                sw = false;
            }

            return sw;
        }

        function guardar(){
          
                $("#form_create").submit();
            
        }
    </script>
@stop