@extends('adminlte::page')

@section('title', 'Proveedores | Creación')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Creacion de Proveedor
                    </div>
                    <a href="{{ route('proveedores.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('proveedores.store') }}" method="post" id="form_create">
                        @csrf
                        @include('proveedores.partials.form')
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

       /* function verificarPassword(){
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
        }*/

        /*function verificarPasswordConfirm(){
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
        }*/

        function validateInputs(){
            var sw = true;

            if(!verificarCampo(document.getElementById('nombre'))){
                sw = false;
            }

            if(!verificarCampo(document.getElementById('nombre_empresa'))){
                sw = false;
            }

           /* if(!verificarPassword()){
                sw = false;
            }

            if(!verificarPasswordConfirm()){
                sw = false;
            }*/

            return sw;
        }

        function guardar(){
            if(validateInputs()){
                $("#form_create").submit();
            }else{
                toastr.error('Por favor rellene los campos obligatorios.', 'Ups!')
            }
        }
    </script>
@stop