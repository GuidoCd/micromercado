<div class="row">
    <div class="col-md-6">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{isset($permiso) ? $permiso->name : ''}}"
            class="form-control form-control-sm">
    </div>
</div>
<div class="row">
    <div class="col-md-12">
            <label for="descripcion">Descripcion:</label>
            <input type="text" name="description" id="description" value="{{isset($permiso) ? $permiso->description : ''}} " class="form-control form-control-sm">
    </div>
</div>