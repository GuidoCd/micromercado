<div class="card card-custom">
    <div class="card-header bg-secondary">
        <div class="row">
            <div class="col-md-4">
                <label for="descripcion">Tipo de Movimiento:</label>
                <select name="tipo_movimiento" id="tipo_movimiento" class="form-control form-control-sm">
                    <option value="">-</option>
                    <option value="1">INGRESO</option>
                    <option value="2">SALIDA</option>
                </select>
            </div>
            <div class="col-md-8">
                <label for="descripcion">Concepto:</label>
                <input type="text" name="descripcion" id="descripcion" value="{{isset($nota) ? $nota->descripcion : ''}}" class="form-control form-control-sm text-uppercase">
            </div>
        </div>
    </div>
</div>