@extends('adminlte::page')

@section('title', 'Micromercado | Personas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">Opciones de Busqueda</div>
                </div>
                <div class="card-body">
                    {{-- 
                {!! Form::model(Request::all(),[ 'method'=>'GET','route'=>'personal.search','class'=>'row']) !!}
                    @include('recursos-humanos.personal.partials.search') 
                {!! Form::close()!!}
                --}}
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Crear de Personas
                    </div> 
                    <a href="{{route('personas.index')}}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('personas.store') }}" method="post" id="form_create">
                        @csrf
                        @include('personas.partials.form')
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

        function toggleInputs(value){
            if (value == "2") {
                $(".email-view").hide();
                $(".auxiliar-view").show();
            }else{
                $(".auxiliar-view").hide();
                $(".email-view").show();
            }
        }

        function guardar(){
            if(validateInputs()){
                $("#form_create").submit();
            }else{
                toastr.error('Por favor rellene los campos obligatorios.', 'Ups!');

            }

        }

        function verificarCampo(input){

            if(input.id == 'tipo'){
                toggleInputs(input.value);
            }

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

            var masculino = document.getElementById('masculino');
            var femenino = document.getElementById('femenino');

            console.log(masculino);
            return sw;
        }
        
        
    </script>
@stop