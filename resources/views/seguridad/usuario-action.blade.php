<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Usuario</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="formUpdate" action="{{ $user->id ? route('usuario.update', $user->id) : route('usuario.store') }}"
            method="post">
            @if ($user->id)
                @method('PUT')
                <input type="hidden" name="id" value="{{ $user->id }}">
            @endif
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="name">Nombre (*)</label>
                        <input name="name" value="{{ $user->name }}" class="form-control form-control-sm"
                            type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="email">Correo electrónico (*)</label>
                        <input name="email" value="{{ $user->email }}" class="form-control form-control-sm"
                            type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="roles">Rol (*)</label>
                        <select name="roles" class="form-control form-control-sm">
                            <option value="">Seleccionar rol</option>
                            @foreach ($roles as $key => $role)
                                <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>
                                    {{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input name="password" class="form-control form-control-sm" type="password"
                            autocomplete="new-password">
                    </div>
                </div>

                <div class="col-lg-12 mt-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> <span
                                id="textoBoton">Actualizar<span></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.modal-content -->
