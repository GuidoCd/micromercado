<form action="{{ route('stocks.search') }}">
    <div class="row">
        <div class="col-md-6" wire:ignore>
            <select id="producto_id" class="form-control form-control-sm">
                <option value="">Producto</option>
                @foreach ($productos as $producto)
                <option value="{{$producto->id}}">{{ $producto->codigo . ' ' . $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary btn-sm">
                <span>
                    <i class="fa fa-search"></i>
                </span>
            </button>
        </div>
    </div>
</form>
