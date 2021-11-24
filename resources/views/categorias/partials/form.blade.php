<div class="row">
    <div class="col-md-3">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" onkeyup="verificarCampo(this)" value="{{ isset($categoria) ? $categoria->nombre : '' }}">
    </div>
</div>