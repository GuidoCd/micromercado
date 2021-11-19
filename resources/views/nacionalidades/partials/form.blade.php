<div class="row">
    <div class="col-md-3">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="nombre" id="nombre" onkeyup="verificarNombre()" value="{{ isset($nacionalidad) ? $nacionalidad->nombre : '' }}">
    </div>
    @if (isset($nacionalidad))
        <div class="col-md-3">
            <label for="estado">
                Estado:
            </label>
            <select name="estado" id="estado" class="form-control form-control-sm">
                <option value="1" {{ $nacionalidad->estado == '1' ? 'selected' : '' }}>HABILITADO</option>
                <option value="2" {{ $nacionalidad->estado == '2' ? 'selected' : '' }}>INHABILITADO</option>
            </select>
        </div>
    @endif
</div>