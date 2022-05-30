@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de Pagos Autogenerados</h4>
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
                                <th>Paciente</th>
                                <th>Documento</th>
                                <th>Fecha</th>
                                <th>Precio</th>
                                <th>Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <td style="font-size: 25px">
                                        @if ($pago->estado == 1)
                                            <i class="fa fa-edit text-success" onclick="pago({{ $pago }})"></i>
                                        @else
                                            {{-- <i class="fa fa-file text-danger" onclick="pago({{ $pago }})"></i> --}}
                                           <a href="{{route('pago.view', $pago->id)}}"> <i class="fa fa-eye text-primary" ></i> </a>
                                        @endif
                                    </td>
                                    <td>{{ $pago->paciente->name }} {{ $pago->paciente->last_name }}</td>
                                    <td>{{ $pago->paciente->document }}</td>
                                    <td>{{ $pago->fecha_generacion }}</td>
                                    <td>{{ $pago->precio }}</td>
                                    <td>{{ $pago->servicio->servicio }}</td>
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
                    <h4 class="title" id="defaultModalLabel">Realizar Pago</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pago.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <p> <b>Paciente: </b> </p>
                                <input type="text" disabled class="form-control" id="paciente">
                            </div>

                            <div class="col-md-6">
                                <p> <b>Servicio Prestado: </b> </p>
                                <input type="text" disabled class="form-control" id="servicio">
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Precio: </b> </p>
                                <input type="text" class="form-control" name="precio" id="precio">
                                <input type="hidden" class="form-control" name="idPago" id="idPago">
                                <input type="hidden" class="form-control" name="idPaciente" id="idPaciente">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Observacion: </b> </p>
                                <input type="text" class="form-control" name="observacion" id="observacion">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Metodo de pago: </b> </p>
                                <select name="metodo_pago" class="form-control" id="">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="1">Visa/Mastercard</option>
                                    <option value="2">Yape/Plin</option>
                                    <option value="3">Efectivo</option>
                                </select>
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

        function pago(pago) {
            $("#idPago").val(pago.id)
            $("#paciente").val(pago.paciente.name + ' ' + pago.paciente.last_name)
            $("#servicio").val(pago.servicio.servicio)
            $("#idPaciente").val(pago.paciente.id)
            $("#observacion").val(pago.observacion)
            $("#defaultModal").modal('show')
        }
    </script>
@endsection
