@extends('adminlte::page')

@section('title', 'Nacionalidad | Edición')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Edicion de Nacionalidad
                    </div>
                    <a href="{{ route('nacionalidades.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('nacionalidades.update') }}" id="form_edit" method="post">
                        <input type="hidden" value="{{ $nacionalidad->id }}" name="nacionalidad_id">
                        @csrf
                        @method('PUT')
                        @include('nacionalidades.partials.form')
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-sm btn-success float-right" onclick="actualizar()">
                                    <span>
                                        <i class="fa fa-save"></i>
                                    </span>
                                    &nbsp;
                                    Actualizar
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

        function actualizar(){
            if(validateInputs()){
                $("#form_edit").submit();
            }else{
                toastr.error('Por favor rellene los campos obligatorios.', 'Ups!')
            }
        }
    </script>
@stop