<x-app-layout>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title">Solicitudes</h5>
                                @can('solicitud-crear')
                                    <button id="btnAdd" class="ml-2 btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i>
                                        <span>Nuevo</span>
                                    </button>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="table-striped table-hover table-sm">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->

    <!--Modal -->
    <div class="modal fade" id="modal-update">
        <div class="modal-dialog modal-lg"></div>
    </div>
    <!-- Fin Modal -->

    @push('scripts')
        <script>
            //Marcando las opciones de menú
            $('#liAlmacen').addClass("menu-open");
            $('#aAlmacen').addClass("active");
            $('#liCategoria').addClass("active");
        </script>
        {{ $dataTable->scripts() }}
        <script>
            //Métodos CRUD
            //Obteniendo el click realizado en la tabla
            $('#table-listado').on('click', '.action', function() {
                let data = $(this).data();
                let id = data.id;
                let op = data.action;
                if (op == 'activar') {
                    Swal.fire({
                        title: 'Eliminar Registro',
                        text: "¿Esta seguro de querer eliminar el registro",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            cambiarActivo(id);
                        }
                    })
                }
                if (op == 'desactivar') {
                    Swal.fire({
                        title: 'Eliminar Registro',
                        text: "¿Esta seguro de querer eliminar el registro?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            cambiarActivo(id);
                        }
                    })
                }
                if (op == 'edit') {
                    $.ajax({
                        method: 'get',
                        url: `{{ url('admin/solicitud/') }}/${id}/edit`,
                        success: function(res) {
                            $('#modal-update').find('.modal-dialog').html(res);
                            $("#textoBoton").text("Actualizar");
                            $('#modal-update').modal("show");
                            guardar();
                        }
                    });
                }
            });
            $('#btnAdd').on('click', function() {
                $.ajax({
                    method: 'get',
                    url: `{{ url('admin/solicitud/create') }}`,
                    success: function(res) {
                        $('#modal-update').find('.modal-dialog').html(res);
                        $("#textoBoton").text("Guardar");
                        $('#modal-update').modal("show");
                        guardar();
                    }
                });
            })

            function guardar() {
                console.log("Llegó a guardar");
                $('#formUpdate').on('submit', function(e) {
                    e.preventDefault();
                    const _form = this;
                    const formData = new FormData(_form);
                    const url = this.getAttribute('action');
                    console.log("URL de la solicitud:", url); // Agregar este console.log para verificar la URL
                    console.log("Datos del formulario:",
                    formData); // Agregar este console.log para verificar los datos del formulario
                    $.ajax({
                        method: 'POST',
                        url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            $('#modal-update').modal("hide");
                            window.LaravelDataTables["table-listado"].ajax.reload();
                            Swal.fire({
                                icon: res.status,
                                title: res.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(res) {
                            console.error("Error en la solicitud AJAX:",
                            res); // Agregar este console.error para ver el error
                            let errors = res.responseJSON?.errors;
                            $(_form).find(`[name]`).removeClass('is-invalid');
                            $(_form).find('.invalid-feedback').remove();
                            if (errors) {
                                for (const [key, value] of Object.entries(errors)) {
                                    $(_form).find(`[name='${key}']`).addClass('is-invalid')
                                    $(_form).find(`#msg_${key}`).parent().append(
                                        `<span class="invalid-feedback">${value}</span>`);
                                }
                            }
                        }
                    });
                })
            }

            //activar
            function cambiarActivo(id) {
                $.ajax({
                    method: 'DELETE',
                    url: `{{ url('admin/solicitud/') }}/${id}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        window.LaravelDataTables["table-listado"].ajax.reload();
                        Swal.fire({
                            icon: res.status,
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(res) {

                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
