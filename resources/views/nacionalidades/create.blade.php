@extends('adminlte::page')

@section('title', 'Nacionalidad | Creación')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Creacion de Nacionalidad
                    </div>
                    <a href="{{ route('nacionalidades.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                   <form action="{{ route('nacionalidades.store') }}" method="post" id="form_create">
                        @csrf
                        @include('nacionalidades.partials.form')
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

        function verificarNombre(){
            var nombre = $("#nombre");
            if(nombre.val()  == ""){
                nombre.removeClass("is-valid");
                nombre.addClass("is-invalid");
                return false;
            }else{
                nombre.removeClass("is-invalid");
                nombre.addClass("is-valid");
                return true;
            }
        }

        function validateInputs(){
            var sw = true;

            if(!verificarNombre()){
                sw = false;
            }

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