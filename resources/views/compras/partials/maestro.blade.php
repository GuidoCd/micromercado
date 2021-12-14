<div class="card card-custom">
    <div class="card-header bg-secondary">
        <div class="row">
            <div class="col-md-5">
                <label for="proveedor_id">Proveedor</label>
                <select name="proveedor_id" id="proveedor_id" class="form-control form-control-sm">
                    <option value="">-</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="concepto">Concepto</label>
                <input type="text" name="concepto" id="concepto" class="form-control form-control-sm text-uppercase">
            </div>
        </div>
    </div>
</div>