<div class="row">
    <div class="col-md-3">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" onkeyup="verificarCampo(this)" value="{{ isset($proveedor) ? $proveedor->nombre : '' }}">
    </div>
    <div class="col-md-3">
        <label for="nombre_empresa">
            Nombre de Empresa
        </label>
        <input type="text" class="form-control form-control-sm" name="nombre_empresa" id="nombre_empresa" onkeyup="verificarCampo(this);"  value="{{ isset($proveedor) ? $proveedor->nombre_empresa : '' }}">
    </div>

    <div class="col-md-3">
        <label for="telefono">
            Telefono
        </label>
        <input type="number" class="form-control form-control-sm" name="telefono" id="telefono" onkeyup="verificarCampo(this);" value="{{ isset($proveedor) ? $proveedor->telefono : '' }}">
    </div>
    {{-- <div class="col-md-3">
        <label for="email">
            Contrase&ntilde;a:
        </label>
        <input type="password" class="form-control form-control-sm" name="password" id="password" onkeyup="verificarPassword(this);">
    </div> --}}
    {{-- <div class="col-md-3">
        <label for="email">
            Confirmar Contrase&ntilde;a:
        </label>
        <input type="password" class="form-control form-control-sm" name="password_confirm" id="password_confirm" onkeyup="verificarPasswordConfirm(this);">
    </div> --}}
</div>