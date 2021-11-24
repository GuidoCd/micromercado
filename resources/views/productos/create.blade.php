@extends('adminlte::page')

@section('title', 'Producto | Creación')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Creacion de Producto
                    </div>
                    <a href="{{ route('productos.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                        </span>
                        &nbsp;
                    </a>
                </div>
                <div class="card-body">
                   <form action="{{ route('productos.store') }}" method="post" id="form_create">
                        @csrf
                        @include('productos.partials.form')
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

        function verificarCosto(){
            var costo = $("#costo");
            if(costo.val()  == ""){
                costo.removeClass("is-valid");
                costo.addClass("is-invalid");
                return false;
            }else{
                costo.removeClass("is-invalid");
                costo.addClass("is-valid");
                return true;
            }
        }

        function verificarPrecio(){
            var precio = $("#precio");
            if(precio.val()  == ""){
                precio.removeClass("is-valid");
                precio.addClass("is-invalid");
                return false;
            }else{
                precio.removeClass("is-invalid");
                precio.addClass("is-valid");
                return true;
            }
        }

        function verificarNacionalidad(){
            var nacionalidad_id = $("#nacionalidad_id");
            if(nacionalidad_id.val()  == ""){
                nacionalidad_id.removeClass("is-valid");
                nacionalidad_id.addClass("is-invalid");
                return false;
            }else{
                nacionalidad_id.removeClass("is-invalid");
                nacionalidad_id.addClass("is-valid");
                return true;
            }
        }

        function verificarCategoria(){
            var categoria_id = $("#categoria_id");
            if(categoria_id.val()  == ""){
                categoria_id.removeClass("is-valid");
                categoria_id.addClass("is-invalid");
                return false;
            }else{
                categoria_id.removeClass("is-invalid");
                categoria_id.addClass("is-valid");
                return true;
            }
        }

        function validateInputs(){
            var sw = true;

            if(!verificarNombre()){
                sw = false;
            }

            if(!verificarCosto()){
                sw = false;
            }

            if(!verificarPrecio()){
                sw = false;
            }

            if(!verificarNacionalidad()){
                sw = false;
            }

            if(!verificarCategoria()){
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