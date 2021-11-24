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
    @if (isset($proveedor))
        <div class="col-md-3">
            <label for="estado">
                Estado
            </label>
            <select name="estado" id="estado" class="form-control form-control-sm">
                <option value="1" {{ $proveedor->estado == '1' ? 'selected' : '' }}>HABILITADO</option>
                <option value="2" {{ $proveedor->estado == '2' ? 'selected' : '' }}>INHABILITADO</option>
            </select>
        </div>
    @endif
</div>