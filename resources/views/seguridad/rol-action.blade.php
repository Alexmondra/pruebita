    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Rol</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formUpdate" action="{{$role->id ? route('rol.update',$role->id) : route('rol.store')}}" method="post">
                @if($role->id)
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $role->id }}">
                @endif
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">Nombre (*)</label>
                            <input name="name" value="{{$role->name}}" class="form-control form-control-sm" type="text" placeholder="Name">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="guard_name">Guard Name (*)</label>
                            <input name="guard_name" value="{{$role->guard_name}}" class="form-control form-control-sm" type="text" placeholder="Guard Name">
                        </div>
                    </div>

                    @if ($role->id)
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Permisos</label>
                        </div>
                        <div class="row">
                            @foreach($permissions as $value)
                            <div class="col-lg-4">
                            <label>
                                <input type="checkbox" name="permissions[]" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                {{ $value->name }}
                            </label>

                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="col-lg-12 mt-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> <span id="textoBoton">Actualizar<span></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
