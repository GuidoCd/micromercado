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
                    fila += datosProducto[2]
                    fila += "<input type='hidden' name='productos_id[]' value='"+datosProducto[0]+"'>"
                fila += "</td>"

                fila += "<td>"
                    fila += datosProducto[1]
                fila += "</td>"

                fila += "<td>"
                    fila += pcantidad
                    fila += "<input type='hidden' name='cantidades[]' value='"+pcantidad+"'>"
                fila += "</td>"

                fila += "<td>"
                    fila += pprecio
                    fila += "<input type='hidden' name='precios[]' value='"+pprecio+"'>"
                fila += "</td>"

                fila += "<td>"
                    fila += pprecio * pcantidad
                fila += "</td>"

                fila += "<td>"
                    fila += datosProducto['0']
                fila += "</td>"

            fila += "</tr>";
            $("#tabla_detalle").append(fila);
            index++;
            console.log(index);
        }
      
        function guardar(){
            $("#form_create").submit();
        }

        $(document).ready(function(){
            index = 0;
            //console.log(index);
        });
    </script>
@stop