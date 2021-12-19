@extends('adminlte::page')

@section('title', 'Compras | Creación')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Creacion de Nota de Compra
                    </div>
                    <a href="{{ route('compras.index') }}" class="btn btn-sm btn-primary float-right">
                        <span>
                            <i class="fa fa-reply"></i>
                         &nbsp;</span>
                       
                    </a>
                </div>
                <div class="card-body">
                   <form action="{{ route('compras.store') }}" method="post" id="form_create">
                        @csrf
                        @include('compras.partials.form')
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
        var index;
        function actualizarUnidad(){
            var pproducto_id = $("#pproducto_id").val();
            var datosProducto = pproducto_id.split('_');
            if(datosProducto.length > 1){
                $("#unidad").val(datosProducto[1]);
            }else{
                $("#unidad").val('');
            }
        }

        function limpiarInputsDetalle(){
            $("#pproducto_id").val("");
            $("#pcantidad").val("");
            $("#pprecio").val("");
            $("#unidad").val("");
        }

        function agregarDetalle(){
            agregarFila();
            limpiarInputsDetalle();
        }

        function agregarFila(){
            var pproducto_id = $("#pproducto_id").val();
            var datosProducto = pproducto_id.split('_');
            var pprecio = $("#pprecio").val();
            var pcantidad = $("#pcantidad").val();
            var fila = "";
            fila += "<tr class='fila-detalle-" + index + "'>";
                fila += "<td>"
                    fila += datosProducto['0']
                fila += "</td>"
            fila += "</tr>";
            $("#tabla_detalle").append(fila);
            index++;
            console.log(index);
        }

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

        $(document).ready(function(){
            index = 0;
            console.log(index);
        });
    </script>
@stop