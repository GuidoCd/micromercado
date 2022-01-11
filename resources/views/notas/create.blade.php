@extends('adminlte::page')

@section('title', 'Usuarios | Creación')

@section('content')
            <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-custom">
                                <div class="card-header bg-secondary">
                                        <div class="card-title">
                                        Creacion de Nota de Movimiento
                                        </div>
                                        <div class="pull-rigth">
                                            <a href="{{route('notas.index')}}" class="btn btn-sm btn-info float-right">
                                                <i class="fa fa-reply"></i>
                                            </a>
                                        </div>
                                </div>
                                <div class="card-body">
                                        <form action="{{route('notas.store')}}" method="post" id="form_create">
                                            @csrf
                                            @include('notas.partials.form')
                                            <div class="col-md-12">
                                                <button class="btn btn-sm btn-success float-right" onclick="guardar()">
                                                    <span>
                                                        <i class="fa fa-save"></i>
                                                    </span>
                                                    &nbsp;
                                                    Guardar
                                                </button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>     
            </div>
    
@stop

@section('css')

@stop

@section('js')
    <script>
        var index=0;
        var totales;
       

        function llenarDatos(){
            var datos = $('#producto_idd').val();
            var vectorDatos = datos.split('_');
            var unidad = vectorDatos[1];
            $('#unidadd').val(unidad);
        }
        function cargarFilas(){
            cargarDetalles();
            limpiarInputs();

        }
        function limpiarInputs(){
            $('#cantidadd').val('');
            $('#preciod').val('');
            $('#unidadd').val('');
            $('#producto_idd').val('');
            $('#fecha_vencimientod').val('');
        }

        function cargarDetalles(){

            var vectorDatos = $('#producto_idd').val();
            var datos = vectorDatos.split('_');
            var item = datos[0];
            
            var precio =  $('#preciod').val()
            var cantidad = $('#cantidadd').val();
            var fecha_vencimiento = $('#fecha_vencimientod').val();
            var importe = cantidad * precio;
            totales.push(importe);       
            
            var fila="<tr class='fila-detalle-"+index+"'>";
                     fila +="<td>";
                         fila += item;
                         fila += "<input type='hidden' name='productos_id[]' value='"+datos[2]+"'>"
                     fila +="</td>";

                     fila +="<td>";
                         fila += fecha_vencimiento;
                         fila += "<input type='hidden' name='fechas_vencimiento[]' value='"+fecha_vencimiento+"'>"
                     fila +="</td>";

                     fila +="<td>";
                         fila += cantidad;
                         fila += "<input type='hidden' name='cantidades[]' value='"+cantidad+"'>"
                     fila +="</td>";

                     fila +="<td>";
                        fila += precio;
                        fila += "<input type='hidden' name='precios[]' value='"+precio+"'>"
                     fila +="</td>";

                     fila +="<td>";
                         fila += importe;
                     fila +="</td>";

                 fila += "</tr>";

                $('#table-detalle').append(fila);   
                index++;   
            var suma=0;  
            for( var i= 0; i < totales.length ; i++){

                suma=suma+totales[i];
            }
             $('#total').val(suma);

        }


      
        function guardar(){

        }
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
        $(document).ready(function(){
            index = 0;
            totales = new Array();
           
        });
    </script>
@stop