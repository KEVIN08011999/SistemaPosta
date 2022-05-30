@extends('layouts.app')



@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de {{ $tipo }}</h4>

                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#defaultModal">
                    <i class="flaticon-381-plus"></i> Agregar Usuario </button>
            </div>
            <div class="card-body">

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block mt-20" style="margin-top: 20px">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> {{ $message }} </strong>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="example" class="display min-w850">
                        <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre Completo</th>
                                @if ($tipo == 'Medicos')
                                    <th>Especialidad</th>
                                @endif
                                <th>Correo</th>
                                <th>Usuario</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->document }}</td>
                                    <td>{{ $usuario->name }} {{ $usuario->last_name }}</td>
                                    @if ($tipo == 'Medicos')
                                        <td>{{$usuario->servicio->servicio}}</td>
                                    @endif
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->user }}</td>
                                    <td>
                                        <i class="fa fa-edit text-success"
                                            onclick="editarUsuario({{ $usuario->id }})"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modales')
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Crear Usuario</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Documento</label>
                                    <input type="text" name="document" onblur="validarDocumento()" id="document"
                                        class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control" id="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" name="email" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="text" name="user" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Clave</label>
                                    <input type="text" name="password" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Tipo Usuario</label>
                                    <select class="form-control show-tick" onchange="mostrar()" name="rol_id" id="rolid">
                                        <option value="">-- Seleccione --</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Medico</option>
                                        <option value="3">Farmaceuta</option>
                                        <option value="4">Paciente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Especialidad</label>
                                    <select class="form-control show-tick" name="idServicio" id="idServicio" disabled>
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($servicios as $servicio)
                                            <option value="{{ $servicio->id }}">{{ $servicio->servicio }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    <button type="submit" disabled id="botonGuardar"
                        class="btn btn-success btn-round waves-effect">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Editar Usuario</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.update') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Documento</label>
                                    <input type="text" name="name" id="idDocumentEdit" class="form-control input-warning"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" name="photo" class="form-control" id="">
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="">
                                    <input type="hidden" name="idUsuario" id="idUsuario" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Apellido</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control"
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Correo</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Telefono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Usuario</label>
                                    <input type="text" name="user" id="user" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Clave</label>
                                    <input type="text" name="password" id="password" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">

                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    <button type="submit" class="btn btn-success btn-round waves-effect">GUARDAR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#example').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Buscar',
                sSearch: '',
                lengthMenu: '_MENU_ Registro por Pagina',
                paginate: {
                    first: "Primera",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultima"
                },
                info: "Mostrando del _START_ a _END_ en _TOTAL_ registros",
            }
        });

        function editarUsuario(idUsuario) {

            axios.get('/api/usuario/' + idUsuario).then((response) => {
                console.log(response.data)
                $("#name").val(response.data.name)
                $("#idUsuario").val(response.data.id)
                $("#last_name").val(response.data.last_name)
                $("#email").val(response.data.email)
                $("#telefono").val(response.data.telefono)
                $("#user").val(response.data.user)
                $("#idDocumentEdit").val(response.data.document)
                $("#rol_id option[value=" + response.data.rol_id + "]").attr("selected", true)
            })
            $("#defaultModal2").modal('show')
        }

        function mostrar() {

            if ($("#rolid").val() == 2) {
                $("#idServicio").attr('disabled', false)
            } else {
                $("#idServicio").attr('disabled', true)
            }
        }

        function validarDocumento() {
            documento = $("#document").val()
            console.log(documento)
            axios.get('/api/validarDocumento/' + documento).then((response) => {
                if (response.data == 0) {
                    $("#botonGuardar").attr('disabled', false)
                    $("#document").addClass("is-valid")
                    $("#document").removeClass("is-invalid")
                } else {
                    $("#document").addClass("is-invalid")
                    $("#botonGuardar").attr('disabled', true)
                }
            })

        }
    </script>
@endsection
