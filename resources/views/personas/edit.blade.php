@extends('adminlte::page')

@section('title', 'Micromercado | Personas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Edicion de Persona
                    </div>
                    <a href="{{ route('personas.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Editar Persona
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('personas.update',$persona)}}" method="post" id='form_edit'>
                        {{-- <input type="hidden" value="{{$persona->id}}" name="persona_id"> --}}
                        @csrf
                        @method('PUT')
                        @include('personas.partials.form')
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

            if(!verificarCampo(document.getElementById('nombre'))){
                sw = false;
            }

            if(!verificarCampo(document.getElementById('ci'))){
                sw = false;
            }
            if(!verificarCampo(document.getElementById('fecha_nacimiento'))){
                sw = false;
            }

            if(!verificarCampo(document.getElementById('direccion'))){
                sw = false;
            }
            if(!verificarCampo(document.getElementById('telefono'))){
                sw = false;
            }

            if(!verificarCampo(document.getElementById('sexo'))){
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