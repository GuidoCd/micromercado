<div class="row">
    <div class="col-md-3">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" onkeyup="verificarCampo(this)" value="{{ isset($persona) ? $persona->nombre : '' }}">
    </div>
    <div class="col-md-3">
        <label for="ci">
            CI:
        </label>
        <input type="text" class="form-control form-control-sm" name="ci" id="ci" onkeyup="verificarCampo(this);" value="{{ isset($persona) ? $persona->ci : '' }}">
    </div>
    <div class="col-md-3">
        <label for="fecha_nacimiento">
            Fecha_Nacimiento:
        </label>
        <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" onkeyup="verificarCampo(this);" value="{{ isset($persona) ? $persona->fecha_nacimiento : '' }}">
    </div>
    <div class="col-md-3">
        <label for="direccion">
            Direccion:
        </label>
        <input type="text" class="form-control form-control-sm" name="direccion" id="direccion" onkeyup="verificarCampo(this);" 
         value="{{isset($persona)? $persona->direccion : ''}}">
    </div>
    <div class="col-md-3">
        <label for="telefono">
            Telefono:
        </label>
        <input type="text" class="form-control form-control-sm" name="telefono" id="telefono" onkeyup="verificarCampo(this);" value="{{isset($persona)? $persona->telefono:''}}">
    </div>
    <div class="col-md-3">
        <label for="tipo">
            Tipo:
        </label>
        <select name="tipo" id="tipo" class="form-control form-control-sm" onselect="verificarTipo(this);">
            
                
            
                @if(isset($persona))
                    @if($persona->tipo=="1")
                    <option value="1" selected>EMPLEADO</option>
                    <option value="2">CLIENTE</option>  
                     @else
                    <option value="1">EMPLEADO</option>
                    <option value="2" selected>CLIENTE</option>
                     @endif
                @else
                     <option value="1" selected>EMPLEADO</option>
                     <option value="2">CLIENTE</option>  
                @endif
        
        </select>
    </div>
    <div class="col-md-3">
        <label for="estado">
           Estado:
        </label>
        <select name="estado" id="estado" class="form-control form-control-sm">
            @if(isset($persona))
                @if($persona->estado =="1")
                <option value="1" selected>HABILITADO</option>
                <option value="2">DESHABILITADO</option>
                @else
                <option value="1">HABILITADO</option>
                <option value="2"selected>DESHABILITADO</option> 
                @endif
           @else
                 <option value="1" selected>HABILITADO</option>
                 <option value="2">DESHABILITADO</option>
               
           @endif

        </select>
    </div>
    <div class="col-md-3 " > 
        <label for="sexo" class="mr-3">
            Sexo:
         </label>
            <div class="form-control form-control-sm">

            @if(isset($persona))
                @if($persona->sexo=="M")
                 <label for="femenino">Femenino </label> 
                 <input type="radio" id="sexo"  name="sexo" value="F" >
                 <label for="masculino">Masculino </label>
                 <input type="radio" id="sexo" checked name="sexo" value="M">      
                 @else
                 <label for="femenino">Femenino </label> 
                 <input type="radio" id="sexo" checked  name="sexo" value="F" >
                 <label for="masculino">Masculino </label>
                 <input type="radio" id="sexo" name="sexo" value="M"> 
                 @endif
            @else
                 <label for="femenino">Femenino </label> 
                 <input type="radio" id="sexo"  name="sexo" value="F" >
                 <label for="masculino">Masculino </label>
                <input type="radio" id="sexo" checked name="sexo" value="M">  
            @endif
            </div>     
        
    </div>
    

</div> 