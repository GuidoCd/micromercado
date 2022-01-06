Detalle de Nota:
<div class="card card-custom">
    <div class="card-header bg-secondary">
        <div class="row">
                <div class="col-md-6">
                    <label for="producto_idd">Producto:</label>
                    <select name="producto_idd" id="producto_idd" class="form-control form-control-sm" onchange="llenarDatos()">
                            <option value="">-</option>
                                @foreach($productos as $producto)
                                    @foreach($unidades as $unidad)
                                      @if($unidad->id == $producto->unidad_id)
                                         <option value="{{ $producto->nombre }}_{{ $producto->unidad != null ? $producto->unidad->abreviacion : 'N/A' }}_{{ $producto->id }}">
                                            {{ $producto->nombre }}</option>
                                      @endif
                                    @endforeach
                                @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="unidadd">Unidad</label>
                    <input type="text" name="unidadd" id="unidadd" class="form-control form-control-sm" readonly>
                </div>
                <div class="col-md-2">
                    <label for="cantidadd">Cantidad:</label>
                    <input type="text" name="cantidadd" id="cantidadd" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <label for="preciod">Precio:</label>
                    <input type="text" name="preciod" id="preciod" class="form-control form-control-sm">
                </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary float-right" onclick="cargarFilas()">
                            <span>
                                <i class="fa fa-plus"></i>
                            </span>
                    </button>
                </div> 
            </div>  
        </div>
    </div>
    <div class="card-body">
            <div class="card-body table-responsive table-striped">
                <table class="table table-hover table-bordered">
                        <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Importe</th>
                                </tr>
                        </thead>
                        <tbody id="table-detalle">
                                <tr class="fila-detalle-0">

                                </tr>
                        </tbody>
                       
                </table>
                <tfoot>
                    <div class="pull-right mt-3">
                        <label for="total">Total: </label>
                             <input type="text" name="total" id="total" class="form form-control-sm float-right"readonly>
                     </div>
                </tfoot>
               
            </div>
    </div>

</div>