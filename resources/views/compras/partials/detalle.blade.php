Detalle de Compra
<div class="card card-custom">
    <div class="card-header bg-secondary">
        <div class="row">
            <div class="col-md-10">
                <label for="pproducto_id">Producto</label>
                <select name="pproducto_id" id="pproducto_id" class="form-control form-control-sm" onchange="actualizarUnidad();">
                    <option value="">-</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}_{{ $producto->unidad != null ? $producto->unidad->abreviacion : 'N/A' }}_{{$producto->nombre}}">{{ $producto->codigo . ' ' . $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="unidad">Unidad</label>
                <input type="text" name="unidad" id="unidad" class="form-control form-control-sm" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="fecha_vencimientod">Fecha Vencimiento:</label>
                <input type="date" name="fecha_vencimientod" id="fecha_vencimientod" class="form-control form-control-sm">
            </div>
            <div class="col-md-2">
                <label for="pcantidad">Cantidad</label>
                <input type="text" name="pcantidad" id="pcantidad" class="form-control form-control-sm">
            </div>
            <div class="col-md-2">
                <label for="pprecio">Precio</label>
                <input type="text" name="pprecio" id="pprecio" class="form-control form-control-sm">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-sm btn-primary" onclick="agregarDetalle();">
                    <span>
                        <i class="fa fa-plus"></i>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body table-responsive table-striped">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>
                            Producto
                        </th>
                        <th>
                            Unidad
                        </th>
                        <th>
                            Cantidad
                        </th>
                        <th>
                            Precio
                        </th>
                        <th>
                            Sub Total
                        </th>
                        <th>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody id="tabla_detalle">
                    <tr class="fila-detalle-0">
                            
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>