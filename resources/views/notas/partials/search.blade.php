<form action="{{ route('notas.search') }}" method="get">
    <div class="row">
        <div class="col-md-6" >
            <select id="tipo_movimiento" name="tipo_movimiento" class="form-control form-control-sm">
                <option value="">Tipo Movimiento</option>
                <option value="1">Ingreso</option>
                <option value="2">Salida</option>
            </select>
        </div>
        <div class="col-md-3" >
            <input type="text" id="codigo" name="codigo" class="form-control form-control-sm" placeholder="Codigo...">
        </div>
        <div class="col-md-3" >
            <select id="estado" name="estado" class="form-control form-control-sm">
                <option value="">Estado</option>
                <option value="1">Pendiente</option>
                <option value="2">Concluida</option>
                <option value="3">Anulada</option>
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
