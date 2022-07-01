@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de Triajes del Dia</h4>
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
                                <th></th>
                                <th></th>
                                <th>Urgencia</th>
                                <th>Especialidad</th>
                                <th>Paciente</th>
                                <th>Documento</th>
                                <th>Fecha</th>
                                <th>Hora</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                                <tr>
                                    <td style="font-size: 25px">
                                        <i class="fa fa-edit text-success"
                                            onclick="triaje({{ $cita }})"></i>
                                    </td>
                                    <td>
                                        @if($cita->archivo != null)
                                            <a href="/uploads/archivos/{{$cita->archivo}}" target="__blank">
                                            <i class="fa fa-file btn btn-danger text-white"></i></a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cita->prioridad == 1)
                                            <button class="btn btn-danger">Urgente</button>
                                        @else
                                            <button class="btn btn-info">Normal</button>
                                        @endif
                                    </td>
                                    <td>{{ $cita->servicio->servicio }}</td>
                                    <td>{{ $cita->paciente->name }} {{ $cita->paciente->last_name }}</td>
                                    <td>{{ $cita->paciente->document }}</td>
                                    <td>{{ $cita->fecha }}</td>
                                    <td>{{ $cita->horario->horario }}</td>
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Triaje de Paciente</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('triaje.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Especialidad: </b> </p>
                                <input type="text" disabled class="form-control" id="especialidad">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Medico: </b> </p>
                                <input type="text" disabled class="form-control" id="medico">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Horario: </b> </p>
                                <input type="text" disabled class="form-control" id="horario">
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Documento: </b> </p>
                                <input type="text" disabled class="form-control" id="document">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Nombre: </b> </p>
                                <input type="text" disabled class="form-control" id="nombre">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Usuario: </b> </p>
                                <input type="text" disabled class="form-control" id="usuario">
                                <input type="hidden" class="form-control" id="idCita" name="idCita">
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Presion Arterial: </b> </p>
                                <input type="text" required class="form-control" name="presion">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Temperatura: </b> </p>
                                <input type="text" required class="form-control" name="temperatura">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Frecuencia Cardiaca: </b> </p>
                                <input type="text" required class="form-control" name="cardiaca">
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Saturacion: </b> </p>
                                <input type="text" required class="form-control" name="saturacion">
                            </div>


                        </div>

                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p> <b>Peso Kg: </b> </p>
                                <input type="text" required class="form-control" name="peso">
                            </div>

                            <div class="col-md-6">
                                <p> <b>Talla CM: </b> </p>
                                <input type="text" required class="form-control" name="talla">
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

        function triaje(cita)
        {
            $("#document").val(cita.paciente.document)
            $("#nombre").val(cita.paciente.name + ' ' + cita.paciente.last_name)
            $("#horario").val(cita.horario.horario)
            $("#usuario").val(cita.paciente.user)
            $("#medico").val(cita.medico.name + ' ' + cita.medico.last_name)
            $("#especialidad").val(cita.servicio.servicio)
            $("#idCita").val(cita.id)
            $("#defaultModal").modal('show')
        }
    </script>
@endsection
