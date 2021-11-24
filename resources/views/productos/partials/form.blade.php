<div class="row">
    @if (isset($producto))
        <div class="col-md-3">
            <label for="estado">
                codigo:
            </label>
            <input type="text" class="form-control form-control-sm text-uppercase" name="codigo" id="codigo" readonly value="{{ $producto->codigo }}">    
        </div>
    @endif
    <div class="col-md-3">
        <label for="nombre">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="nombre" id="nombre" onkeyup="verificarNombre()" value="{{ isset($producto) ? $producto->nombre : '' }}">
    </div>
    <div class="col-md-3">
        <label for="costo">
            Costo:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="costo" id="costo" onkeyup="verificarCosto()" value="{{ isset($producto) ? $producto->costo : '' }}">
    </div>
    <div class="col-md-3">
        <label for="precio">
            Precio:
        </label>
        <input type="text" class="form-control form-control-sm text-uppercase" name="precio" id="precio" onkeyup="verificarPrecio()" value="{{ isset($producto) ? $producto->precio : '' }}">
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <label for="fecha_vencimiento">Fecha Vencimiento</label>
        <input type="date" class="form-control form-control-sm" name="fecha_vencimiento" id="fecha_vencimiento" value="{{ isset($producto) ? $producto->fecha_vencimiento : '' }}">
    </div>
    <div class="col-md-4">
        <label for="categoria_id">Categoria</label>
        <select name="categoria_id" id="categoria_id" class="form-control form-control-sm">
            <option value="">-</option>
            @foreach ($categorias as $categoria)
                @isset($producto)
                    @if ($producto->categoria_id == $categoria->id)
                        <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>    
                    @else
                        <option value="{{ $categoria->id }}" selected>{{ $categoria->nombre }}</option>    
                    @endif
                @else
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endisset
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="nacionalidad_id">Nacionalidad</label>
        <select name="nacionalidad_id" id="nacionalidad_id" class="form-control form-control-sm">
            <option value="">-</option>
            @foreach ($nacionalidades as $nacionalidad)
                @isset($producto)
                    @if ($producto->nacionalidad_id == $nacionalidad->id)
                        <option value="{{ $nacionalidad->id }}" selected>{{ $nacionalidad->nombre }}</option>
                    @else
                        <option value="{{ $nacionalidad->id }}">{{ $nacionalidad->nombre }}</option>
                    @endif
                @else
                    <option value="{{ $nacionalidad->id }}">{{ $nacionalidad->nombre }}</option>
                @endisset
            @endforeach
        </select>
    </div>
</div>