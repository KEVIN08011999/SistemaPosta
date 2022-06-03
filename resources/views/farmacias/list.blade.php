@extends('layouts.app')



@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Buscar Pacientes</h4>
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

                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->user }}</td>
                                    <td>
                                        <a href="#recetas" onclick="verRecetas({{ $usuario }})"
                                            class="btn btn-success">Recetas</a>
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
    <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Listado de Recetas</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example2" class="display min-w850">
                            <thead>
                                <tr width="100%">
                                    <th width="30%">Diagnostico</th>
                                    <th width="30%">Fecha</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody id="recetasLista">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Receta</h4>
                </div>
                <div class="modal-body">
                    <div class="row clearfix" style="margin-top: 15px">
                        <div class="table-responsive">
                            <table class="display min-w850 table table-hover table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th>Medicamento</th>
                                        <th>Presentacion</th>
                                        <th>Dosis</th>
                                        <th>Duracion</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="recetasReceta">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
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

        $('#example2').DataTable({
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

        function verRecetas(data) {
            console.log(data.citas_data)
            diagnosticos = data.citas_data
            $("#recetasLista").html("")

            diagnosticos.forEach(function(diagnostico, index) {
                console.log(diagnostico)
                if(diagnostico.diagnostico.diagostico != null)
                {
                    $("#recetasLista").append("<tr><td>" + diagnostico.diagnostico.diagostico + "</td><td>" +
                    diagnostico.fecha + "</td><td><a href='/pdfs/receta/"+diagnostico.id+"'><i class='fa fa-file btn btn-danger text-white'></i></a><i onclick='verReceta(" + diagnostico.diagnostico.id +
                    ")' class='fa fa-eye text-white btn btn-success'></i></td></tr>");
                }

            });


            $("#defaultModal2").modal('show')
        }

        function verReceta(recetas) {
            console.log(recetas)
            axios.get('/api/receta/' + recetas).then((response) => {
                $("#recetasReceta").html(response.data)
                $("#defaultModal").modal('show')
                $("#defaultModal").modal('show')
            })
        }
    </script>
@endsection
