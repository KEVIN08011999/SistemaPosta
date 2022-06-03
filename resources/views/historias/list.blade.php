@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Historia Clinica: ({{ $paciente->document }}) - {{ $paciente->name }}
                    {{ $paciente->last_name }}</h4>
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
                                <th>Fecha</th>
                                <th>Visita A:</th>
                                <th>Diagnostico</th>
                                <th>Receta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                                @if ($cita->diagnostico->motivo != null)
                                    <tr>
                                        <td> {{ $cita->fecha }} </td>
                                        <td> {{ $cita->servicio->servicio }} </td>
                                        <td class="text-center">
                                            <i onclick="verDiagnostico({{ $cita }})"
                                                class="fa fa-eye btn btn-info text-white"></i>
                                                <a href="{{ route('pdf.diagnostico', $cita) }}">
                                            <i class="fa fa-file btn btn-danger text-white"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <i onclick="verReceta({{ $cita }})"
                                                class="fa fa-eye btn btn-warning text-white"></i>
                                            <a href="{{ route('pdf.receta', $cita) }}"><i
                                                    class="fa fa-file btn btn-danger text-white"></i></a>
                                        </td>
                                    </tr>
                                @endif
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
                    <h4 class="title" id="defaultModalLabel">Diagnostico</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diagnostico.store') }}" method="post" autocomplete="off"
                        accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Paciente: </b> </p>
                                <input type="text" disabled class="form-control" id="paciente">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Medico: </b> </p>
                                <input type="text" disabled class="form-control" id="medico">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Servicio Prestado: </b> </p>
                                <input type="text" disabled class="form-control" id="servicio">
                            </div>
                        </div>

                        <h3 style="margin-top: 20px">Triaje</h3>

                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Presion Arterial: </b> </p>
                                <input type="text" class="form-control" disabled name="presion" id="presion">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Temperatura: </b> </p>
                                <input type="text" class="form-control" disabled name="temperatura" id="temperatura">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Frecuencia Cardiaca: </b> </p>
                                <input type="text" class="form-control" disabled name="cardiaca" id="cardiaca">
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-md-4">
                                <p> <b>Saturacion: </b> </p>
                                <input type="text" class="form-control" disabled name="saturacion" id="saturacion">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Peso Kg: </b> </p>
                                <input type="text" class="form-control" disabled name="peso" id="peso">
                            </div>

                            <div class="col-md-4">
                                <p> <b>Talla CM: </b> </p>
                                <input type="text" class="form-control" disabled name="talla" id="talla">
                            </div>

                        </div>

                        <h3 style="margin-top: 20px">Diagnostico</h3>

                        <div class="row clearfix">
                            <div class="col-md-8">
                                <p> <b>Motivo de Visita: </b> </p>
                                <textarea name="motivo" id="motivo" disabled class="form-control" rows="7"></textarea>
                            </div>

                            <div class="col-md-4">
                                <p> <b>VACUNAS COMPLETAS: </b> </p>
                                <select name="vacunas" id="vacunas" disabled class="form-control" id="">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="1">SI</option>
                                    <option value="2">NO</option>
                                </select>

                                <p> <b>TIPO DE DIAGNOSTICO: </b> </p>
                                <select name="tipo_diagnostico" id="tipo_diagnostico" disabled class="form-control" id="">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="1">PRESUNTIVO</option>
                                    <option value="2">DEFINITIVO</option>
                                    <option value="3">REPETIDO</option>
                                </select>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-8">
                                <p> <b>Antecedentes: </b> </p>
                                <textarea name="antecedentes" id="antecedentes" disabled class="form-control" rows="7"></textarea>
                            </div>

                            <div class="col-md-4">
                                <p> <b>Tiempo de Sintomas: </b> </p>
                                <input type="text" class="form-control" disabled id="tiempo_efermedad"
                                    name="tiempo_enfermedad">

                                <p> <b>Alergias: </b> </p>
                                <input type="text" class="form-control" name="alergias" id="alergias">
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-8">
                                <p> <b>Examen Fisico: </b> </p>
                                <textarea name="examen" id="examen" disabled class="form-control" rows="7"></textarea>
                            </div>

                            <div class="col-md-4">
                                <p> <b>Intervenciones: </b> </p>
                                <input type="text" class="form-control" name="intervenciones" id="intervenciones"
                                    disabled>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-12">
                                <p> <b>Diagnostico: </b> </p>
                                <textarea name="diagnostico" id="diagnostico" disabled class="form-control" rows="7"></textarea>
                            </div>

                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-12">
                                <p> <b>Tratamiento: </b> </p>
                                <textarea name="tratamiento" id="tratamiento" disabled class="form-control" rows="7"></textarea>
                            </div>

                        </div>

                        <h3 style="margin-top: 20px">Receta Medica</h3>
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
                                    <tbody id="recetas">

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

    <div class="modal fade" id="defaultModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">Receta</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diagnostico.store') }}" method="post" autocomplete="off"
                        accept-charset="UTF-8" enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-12">
                                <p> <b>Diagnostico: </b> </p>
                                <span id="diagnosticoReceta"></span>
                            </div>

                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-12">
                                <p> <b>Tratamiento: </b> </p>
                                <span id="tratamientoReceta"></span>
                            </div>

                        </div>

                        <h3 style="margin-top: 20px">Receta Medica</h3>
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

        function verDiagnostico(cita) {
            $("#paciente").val(cita.paciente.name + ' ' + cita.paciente.last_name)
            $("#medico").val(cita.medico.name + ' ' + cita.medico.last_name)
            $("#servicio").val(cita.servicio.servicio)
            $("#presion").val(cita.diagnostico.triaje.presion)
            $("#temperatura").val(cita.diagnostico.triaje.temperatura)
            $("#cardiaca").val(cita.diagnostico.triaje.cardiaca)
            $("#saturacion").val(cita.diagnostico.triaje.saturacion)
            $("#peso").val(cita.diagnostico.triaje.peso)
            $("#talla").val(cita.diagnostico.triaje.talla)
            $("#idDiagnostico").val(cita.id)
            $("#idPaciente").val(cita.paciente.id)
            $("#motivo").val(cita.diagnostico.motivo)
            $("#vacunas").val(cita.diagnostico.vacunas)
            $("#tipo_diagnostico").val(cita.diagnostico.tipo_diagnostico)
            $("#antecedentes").val(cita.diagnostico.antecedentes)
            $("#tiempo_efermedad").val(cita.diagnostico.tiempo_enfermedad)
            $("#alergias").val(cita.diagnostico.alergias)
            $("#examen").val(cita.diagnostico.examen)
            $("#intervenciones").val(cita.diagnostico.intervenciones)
            $("#diagnostico").val(cita.diagnostico.diagostico)
            $("#tratamiento").val(cita.diagnostico.tratamiento)

            axios.get('/api/receta/' + cita.diagnostico.id).then((response) => {
                $("#recetas").html(response.data)
                $("#defaultModal").modal('show')
            })
        }

        function verReceta(cita) {
            $("#diagnosticoReceta").html(cita.diagnostico.diagostico)
            $("#tratamientoReceta").html(cita.diagnostico.tratamiento)

            axios.get('/api/receta/' + cita.diagnostico.id).then((response) => {
                $("#recetasReceta").html(response.data)
                $("#defaultModal2").modal('show')
            })
        }
    </script>
@endsection
