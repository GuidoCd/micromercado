<form action="{{ route('stocks.search') }}" method="get">
    <div class="row">
        <div class="col-md-6" >
            <select id="producto_id" name="producto_id" class="form-control form-control-sm">
                <option value="">Producto</option>
                @foreach ($productos as $producto)
                <option value="{{$producto->id}}">{{ $producto->codigo . ' ' . $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3" >
            <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control form-control-sm">
        </div>
        <div class="col-md-3" >
            <select id="con_stock" name="con_stock" class="form-control form-control-sm">
                <option value="">Todos</option>
                <option value="1">Con Stock</option>
                <option value="2">Sin Stock</option>
            </select>
        </div>
    </div>
    <div class="row mt-1">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <span>
                    <i class="fa fa-search"></i>
                </span>
            </button>
            <button type="button" class="btn btn-success btn-sm" onclick="exportarExcel();">
                <span>
                    <i class="fa fa-file-excel"></i>
                </span>
            </button>
        </div>
    </div>
</form>
