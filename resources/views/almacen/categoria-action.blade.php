    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Categoría</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formUpdate" action="{{$categoria->id ? route('categoria.update',$categoria) : route('categoria.store')}}" method="post" enctype="multipart/form-data">
                @if($categoria->id)
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $categoria->id }}">
                @endif
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nombre">Nombre (*)</label>
                            <input name="nombre" value="{{$categoria->nombre}}" class="form-control form-control-sm" type="text">
                            <div id="msg_nombre"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="imagen">Imagen</label>
                            <input accept="image/*" name="imagen" value="{{$categoria->imagen}}" class="form-control form-control-sm" type="file" placeholder="">
                            @if($categoria->id)
                            <div>Imagen actual: {{$categoria->imagen}}</div>
                            <div><img src="{{ asset('uploads/categorias/' . $categoria->imagen) }}" width="40" class="img-rounded"/></div>
                            @endif
                            <div id="msg_imagen"></div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> <span id="textoBoton">Actualizar<span></button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.modal-content -->
