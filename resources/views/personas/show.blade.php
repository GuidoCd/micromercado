@extends('adminlte::page')

@section('title', 'Micromercado | Personas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom">
                <div class="card-header bg-secondary">
                    <div class="card-title">
                        Persona
                    </div> 
                            <a href="{{route('personas.index')}}" class="btn btn-sm btn-primary float-right">
                               <span>
                                    <i class="fa fa-reply"></i>
                                </span>
                            </a>
                   
                </div>
                
                <div class="card-body">
                    <div class="col">
                         <div class="col-md-3">

                            <div class="col-md-3">
                                <label for="nombre">
                                    Nombre:
                                     <input type="text" name="nombre" id="nombre" value="{{$persona->nombre}}" readonly disabled>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="ci">
                                    Ci:
                                     <input type="text" name="ci" id="ci" value="{{$persona->ci}}" readonly disabled>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="sexo">
                                    Sexo:
                                     <input type="text" name="sexo" id="sexo" value="{{$persona->sexo}}" readonly disabled>
                                </label>
                            </div>
                            <div class="col-md-3 ">
                                <label for="fecha_nacimiento">
                                    Fecha Nacimiento:
                                     <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="{{$persona->fecha_nacimiento}}" readonly disabled>
                                </label>
                            </div>
                            <div class="col-md-3 ">
                                <label for="direccion">
                                    Direccion:
                                     <input type="text" name="direccion" id="direccion" value="{{$persona->direccion}}" readonly disabled>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label for="telefono">
                                    Telefono:
                                     <input type="text" name="telefono" id="telefono" value="{{$persona->telefono}}" readonly disabled>
                                </label>
                            </div>
                            <div class="col-md-3 ">
                                <label for="tipo">
                                    Tipo:
                                     <input type="text" name="tipo" id="tipo" value="{{$persona->tipo_persona}}" readonly disabled>
                                </label>
                            </div>

                            <div class="col-md-3 ">
                                <label for="estado">
                                    Estado:
                                     <input type="text" name="tipo" id="tipo" value="{{$persona->estado_descripcion}}" readonly disabled>
                                </label>
                            </div>


                         </div>
                    </div>
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
       
    </script>
@stop