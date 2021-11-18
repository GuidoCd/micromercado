<div class="row">
    <div class="col-md-3">
        <label for="name">
            Nombre:
        </label>
        <input type="text" class="form-control form-control-sm" name="name" id="name" onkeyup="verificarCampo(this)" value="{{ isset($usuario) ? $usuario->name : '' }}">
    </div>
    <div class="col-md-3">
        <label for="email">
            E-mail:
        </label>
        <input type="text" class="form-control form-control-sm" name="email" id="email" onkeyup="verificarCampo(this);" value="{{ isset($usuario) ? $usuario->email : '' }}">
    </div>
    <div class="col-md-3">
        <label for="email">
            Contrase&ntilde;a:
        </label>
        <input type="password" class="form-control form-control-sm" name="password" id="password" onkeyup="verificarPassword(this);">
    </div>
    <div class="col-md-3">
        <label for="email">
            Confirmar Contrase&ntilde;a:
        </label>
        <input type="password" class="form-control form-control-sm" name="password_confirm" id="password_confirm" onkeyup="verificarPasswordConfirm(this);">
    </div>
</div>