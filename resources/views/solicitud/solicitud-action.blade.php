<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">{{ isset($solicitud->id) ? 'Actualizar Solicitud' : 'Crear Nueva Solicitud' }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="formUpdate"
            action="{{ isset($solicitud->id) ? route('solicitud.update', $solicitud->id) : route('solicitud.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($solicitud->id))
                @method('PUT')
            @endif
            <div class="row">
                @if (isset($solicitud->id))
                    <!-- View for Editing -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="user_id">Usuario (*)</label>
                            <input type="text" name="user_id" class="form-control form-control-sm"
                                value="{{ $solicitud->user->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tipo">Tipos (*)</label>
                            <select name="tipo" class="form-control form-control-sm" disabled>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->nombre }}" {{ $solicitud->tipo === $categoria->nombre ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="comentario">Comentario (*)</label>
                            <textarea name="comentario" class="form-control form-control-sm" readonly>{{ $solicitud->comentario }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="observaciones">Observaciones</label>
                            <input type="text" name="observaciones" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="estado">Estado (*)</label>
                            <input type="text" name="estado" class="form-control form-control-sm"
                                value="{{ $solicitud->estado }}">
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="fecha_envio">Fecha de Envío (*)</label>
                            <input type="text" name="fecha_envio" class="form-control form-control-sm"
                                value="{{ \Carbon\Carbon::now()->toDateString() }}" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="user_id">Usuario (*)</label>
                            <input type="text" name="user_id" class="form-control form-control-sm"
                                value="{{ auth()->user()->name }}" required readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tipo">Tipo (*)</label>
                            <select name="tipo" class="form-control form-control-sm" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="comentario">Comentario</label>
                            <textarea name="comentario" class="form-control form-control-sm" required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="archivo">Archivo</label>
                            <input type="file" name="archivo" class="form-control form-control-sm">
                        </div>
                    </div>
                @endif
                <div class="col-lg-12 mt-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-save"></i> {{ isset($solicitud->id) ? 'Actualizar' : 'Guardar' }}
                        </button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
