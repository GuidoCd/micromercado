<div class="row">
    <div class="col-md-3">
        <label for="tipo">
            Tipo:
        </label>
        <select name="tipo" id="tipo" class="form-control form-control-sm" onchange="verificarCampo(this);">
                @if(isset($persona))
                    @if($persona->tipo=="1" || Input::old('tipo') == 1)
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
    <div class="col-md-3 email-view" >
        <label for="role_id">
            Cargo:
        </label>
        <select name="role_id" id="role_id" class="form-control form-control-sm">
            <option value="">-</option>
                @if(isset($persona))
                    @foreach($roles as $role)
                        @if ($user != null && $role->id  == $user->role_id)
                            <option value="{{ $role->id }}" selected >{{ $role->name }}</option>
                        @else
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" >{{ $role->name }}</option>
                    @endforeach
                @endif
        </select>
    </div>
    <div class="col-md-3">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="nombre" id="nombre" onkeyup="verificarCampo(this)" value="{{ isset($persona) ? $persona->nombre : old('nombre') }}">
    </div>
    <div class="col-md-3">
        <label for="ci">
            CI:
        </label>
        <input type="text" class="form-control form-control-sm" name="ci" id="ci" onkeyup="verificarCampo(this);" value="{{ isset($persona) ? $persona->ci : old('ci') }}">
    </div>
    <div class="col-md-3">
        <label for="fecha_nacimiento">
            Fecha Nacimiento:
        </label>
        <input type="date" class="form-control form-control-sm" name="fecha_nacimiento" id="fecha_nacimiento" onkeyup="verificarCampo(this);" value="{{ isset($persona) ? $persona->fecha_nacimiento : old('fecha_nacimiento') }}">
    </div>
    <div class="col-md-3">
        <label for="direccion">
            Direccion:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="direccion" id="direccion" onkeyup="verificarCampo(this);" 
         value="{{isset($persona)? $persona->direccion : old('direccion')}}">
    </div>
    <div class="col-md-3">
        <label for="telefono">
            Telefono:
        </label>
        <input type="text" class="form-control form-control-sm" name="telefono" id="telefono" onkeyup="verificarCampo(this);" value="{{isset($persona)? $persona->telefono:old('telefono')}}">
    </div>
    @if(isset($persona))
        <div class="col-md-3">
            <label for="estado">
            Estado:
            </label>
            <select name="estado" id="estado" class="form-control form-control-sm">
                @if($persona->estado =="1")
                    <option value="1" selected>HABILITADO</option>
                    <option value="2">DESHABILITADO</option>
                @else
                    <option value="1">HABILITADO</option>
                    <option value="2"selected>DESHABILITADO</option> 
                @endif
            </select>
        </div>
    @endif
    <div class="col-md-3"> 
        <label for="sexo" class="mr-3">
            Sexo:
        </label>
        <div class="form-control form-control-sm">
            @if(isset($persona))
                @if($persona->sexo == "M" || old('sexo') == "M")
                    <label for="femenino">
                        <input type="radio" id="femenino"  name="sexo" value="F" >
                        Femenino
                    </label>
                    
                    <label for="masculino">
                        <input type="radio" id="masculino" checked name="sexo" value="M">
                        Masculino
                    </label>
                @else
                    <label for="femenino">
                        <input type="radio" id="femenino" checked  name="sexo" value="F" >
                        Femenino
                    </label> 
                    
                    <label for="masculino">
                        <input type="radio" id="masculino" name="sexo" value="M"> 
                        Masculino
                    </label>
                @endif
            @else
                @if(old('sexo') == "M")
                    <label for="femenino">
                        <input type="radio" id="femenino"  name="sexo" value="F" >
                        Femenino
                    </label>
                    
                    <label for="masculino">
                        <input type="radio" id="masculino" checked name="sexo" value="M">
                        Masculino
                    </label>
                @else
                    <label for="femenino">
                        <input type="radio" id="femenino" checked  name="sexo" value="F" >
                        Femenino
                    </label> 
                    
                    <label for="masculino">
                        <input type="radio" id="masculino" name="sexo" value="M"> 
                        Masculino
                    </label>
                @endif
            @endif
        </div>
    </div>
    <div class="col-md-3 email-view">
        <label for="email">E-mail</label>
        <input type="text" name="email" class="form-control form-control-sm">
    </div>
</div>
<div class="row">
    <div class="col-md-3 auxiliar-view" style="display: none">
        <label for="razon_social">
            Razon Social:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="razon_social" id="razon_social" onkeyup="verificarCampo(this)" value="{{ isset($auxiliar) ? $auxiliar->razon_social : '' }}">
    </div>
    <div class="col-md-3 auxiliar-view" style="display: none">
        <label for="nit">
            Nit:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="nit" id="nit" onkeyup="verificarCampo(this)" value="{{ isset($auxiliar) ? $auxiliar->nit : '' }}">
    </div>
</div>