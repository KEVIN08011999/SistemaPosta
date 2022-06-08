@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de Servicios</h4>

                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#defaultModal">
                    <i class="flaticon-381-plus"></i> Agregar Servicio </button>
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
                                <th>Id</th>
                                <th>Servicio</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicios as $servicio)
                                <tr>
                                    <td>{{ $servicio->id }}</td>
                                    <td>{{ $servicio->servicio }} </td>
                                    <td style="font-size: 25px">
                                        <i class="fa fa-edit text-success"
                                            onclick="editarServicio({{ $servicio }})"></i>
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
                    <h4 class="title" id="defaultModalLabel">Crear Servicio</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('servicio.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Servicio</label>
                                    <input type="text" name="servicio" required class="form-control" placeholder="">
                                </div>
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


    <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Editar Servicio</h4>
                </div>
                <div class="modal-body">

                    <form action="{{ route('servicio.update') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Servicio</label>
                                    <input type="text" name="servicio" id="servicio" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="idServicio" id="idServicio" class="form-control" placeholder="" />
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

        function editarServicio(servicio) {
            $("#servicio").val(servicio.servicio)
            $("#idServicio").val(servicio.id)
            $("#defaultModal2").modal('show')
        }
    </script>
@endsection
