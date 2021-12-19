    Detalle de venta:
    <div class="card card-custom">
        <div class="card-header bg-secondary">
            <div class="row">
                <div class="col-md-2">
                        <label for="nombred"> Producto:</label>

                        <select name="nombred" id="nombred"class="form-control form-control-sm" onchange="cambiarDatos()">
                            <option value="">-</option>
                                @foreach ($productos as $producto)
                                    <option value="{{$producto->id}}_{{$producto->nombre}}_{{$producto->precio}}_{{$producto->codigo}}">
                                    {{$producto->nombre}}</option>
                                @endforeach
                        </select>
                        
                        
                </div>
                <div class="col-md-6">
                        <label for="codigod">Codigo: </label>
                         <input type="text" name="codigod" id="codigod" class="form-control form-control-sm" >
    

                </div>
                <div class="col-md-2">
                    <label for="preciod">Precio: </label>
                    <input type="text" name="preciod" id="preciod" class="form-control form-control-sm" >
                    
                </div>
                <div class="col-md-2">
                    <label for="cantidadd">Cantidad: </label> 
                    <input type="text" name="cantidadd" id="cantidadd" class="form-control form-control-sm">
                   
                </div>
               
               
                
                
        </div>
        <div class="row mt-2">
            <div class="col-md-12 text-right">
                <button type="button" class="btn btn-sm btn-primary" onclick="llenarDetalles();">
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
                    <thead class="bg-secondary">
                        <tr>
                            <th>Item</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Importe</th>
                        </tr>
                    </thead>

                    <tbody id="tabla-detalle">
                        <tr class="fila-detalle-0">

                        </tr>
                    </tbody>
                   
                </table>
                <div class="pull-right">
                    <input type="text" name="total" id="total" class="form-control form-control-sm float-right" readonly>
                </div>
            </div>
            
        </div>
    </div>
   
</div>