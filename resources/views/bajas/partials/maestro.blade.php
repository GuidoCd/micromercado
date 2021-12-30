<div class="card card-custom">
    <div class="card-header bg-secondary">
        <div class="col-md-12">
            <label for="descripcion">Concepto:</label>
            <input type="text" name="descripcion" id="descripcion" value="{{isset($baja) ? $baja->descripcion : ''}}" class="form-control form-control-sm text-uppercase">
        </div>
    </div>

</div>