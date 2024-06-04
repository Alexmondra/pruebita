    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tipo solicitud</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="formUpdate" action="{{$tipoSolicitud->id ? route('tipoSolicitud.update',$tipoSolicitud) : route('tipoSolicitud.store')}}" method="post" enctype="multipart/form-data">
                @if($tipoSolicitud->id)
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $tipoSolicitud->id }}">
                @endif
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                          
                            <input name="nombre" value="{{$tipoSolicitud->nombre}}" class="form-control form-control-sm" type="text" placeholder="nombre de solicitud">
                            <div id="msg_nombre"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                           
                            <input accept="image/*" name="imagen" value="{{$tipoSolicitud->imagen}}" class="form-control form-control-sm" type="file" placeholder="">
                            @if($tipoSolicitud->id)
                            <div>Imagen actual: {{$tipoSolicitud->imagen}}</div>
                            <div><img src="{{ asset('uploads/tipoSolicitudes/' . $tipoSolicitud->imagen) }}" width="40" class="img-rounded"/></div>
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
