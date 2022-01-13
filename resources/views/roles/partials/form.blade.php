<div class="row">
        <div class="col-md-6">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{isset($role) ? $role->name : ''}}"
                class="form-control form-control-sm">
        </div>
</div>
<div class="row">
        <div class="col-md-12">
                <div class="card">
                        <div class="card-body">
                                <div style="height:400px;overflow-y: scroll;" class="col-md-12">
                                        @foreach($permisos as $permiso)
                                                <div class="row">
                                                        <div class="col-md-12">
                                                                <label for="permiso_id">
                                                                        <input type="checkbox" {{$permiso->checked == 1 ?'checked' : ''}}  name="permissions[]" value="{{$permiso->name}}">
                                                                        {{$permiso->description}}
                                                                </label>
                                                        </div>
                                                </div>
                                        @endforeach
                                </div>
                        </div>
                </div>
        </div>
</div>