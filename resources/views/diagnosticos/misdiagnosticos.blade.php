@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listado de Diagnosticos Por Realizar</h4>
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
                                <th>Medico</th>
                                <th>Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diagnosticos as $diagnostico)
                                <tr>
                                    <td style="font-size: 25px">
                                        @if ($diagnostico->diagnostico->estado == 1)
                                            <i class="fa fa-edit text-success"
                                                onclick="diagnostico({{ $diagnostico }})"></i>
                                        @else
                                            {{-- <i class="fa fa-file text-danger" onclick="diagnostico({{ $diagnostico }})"></i> --}}
                                            {{-- <a href="{{ route('diagnostico.view', $diagnostico->id) }}"> <i
                                                    class="fa fa-eye text-primary"></i> </a> --}}
                                        @endif
                                    </td>
                                    <td>{{ $diagnostico->diagnostico->cita->paciente->name }}
                                        {{ $diagnostico->diagnostico->cita->paciente->last_name }}</td>
                                    <td>{{ $diagnostico->diagnostico->cita->paciente->document }}</td>
                                    <td>{{ $diagnostico->diagnostico->cita->medico->name }}
                                        {{ $diagnostico->diagnostico->cita->medico->last_name }}</td>
                                    <td>{{ $diagnostico->diagnostico->cita->servicio->servicio }}</td>
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
                    <h4 class="title" id="defaultModalLabel">Diagnostico</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('diagnostico.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
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
                                <textarea name="motivo" id="" class="form-control" rows="7"></textarea>
                            </div>

                            <div class="col-md-4">
                                <p> <b>VACUNAS COMPLETAS: </b> </p>
                                <select name="vacunas" class="form-control" id="">
                                    <option value="">-- SELECCIONE --</option>
                                    <option value="1">SI</option>
                                    <option value="2">NO</option>
                                </select>

                                <p> <b>TIPO DE DIAGNOSTICO: </b> </p>
                                <select name="tipo_diagnostico" class="form-control" id="">
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
                                <textarea name="antecedentes" id="" class="form-control" rows="7"></textarea>
                            </div>

                            <div class="col-md-4">
                                <p> <b>Tiempo de Sintomas: </b> </p>
                                <input type="text" class="form-control" name="tiempo_enfermedad">

                                <p> <b>Alergias: </b> </p>
                                <input type="text" class="form-control" name="alergias">
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-8">
                                <p> <b>Examen Fisico: </b> </p>
                                <textarea name="examen" id="" class="form-control" rows="7"></textarea>
                            </div>

                            <div class="col-md-4">
                                <p> <b>Intervenciones: </b> </p>
                                <input type="text" class="form-control" name="intervenciones">
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-12">
                                <p> <b>Diagnostico: </b> </p>
                                <textarea name="diagnostico" id="" class="form-control" rows="7"></textarea>
                            </div>

                        </div>

                        <div class="row clearfix" style="margin-top: 15px">
                            <div class="col-md-12">
                                <p> <b>Tratamiento: </b> </p>
                                <textarea name="tratamiento" id="" class="form-control" rows="7"></textarea>
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

                            <div class="col-md-2">
                                <p> <b>Medicamento: </b> </p>
                                <input type="text" name="medicamento" id="medicamento" class="form-control">
                                <input type="hidden" name="idPaciente" id="idPaciente" class="form-control">
                                <input type="hidden" name="idDiagnostico" id="idDiagnostico" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <p> <b>Presentacion: </b> </p>
                                <input type="text" name="presentacion" id="presentacion" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <p> <b>Dosis: </b> </p>
                                <input type="text" name="dosis" id="dosis" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <p> <b>Duracion: </b> </p>
                                <input type="text" name="duracion" id="duracion" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <p> <b>Cantidad: </b> </p>
                                <input type="text" name="cantidad" id="cantidad" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <p class="text-white">  .</p>
                                <button type="button" onclick="agregarReceta()" class="btn btn-success btn-round waves-effect">Agregar</button>
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

        function agregarReceta()
        {
            const data = {
                'idDiagnostico': $("#idDiagnostico").val(),
                'idPaciente': $("#idPaciente").val(),
                'medicamento': $("#medicamento").val(),
                'presentacion': $("#presentacion").val(),
                'dosis': $("#dosis").val(),
                'duracion': $("#duracion").val(),
                'cantidad': $("#cantidad").val(),
            }

            console.log(data)

            axios.post('/api/receta', data).then((response) => {
                $("#recetas").html(response.data)
                $("#medicamento").val("")
                $("#presentacion").val("")
                $("#dosis").val("")
                $("#duracion").val("")
                $("#cantidad").val("")
            })
        }

        function diagnostico(diagnostico) {
            $("#paciente").val(diagnostico.cita.paciente.name + ' ' + diagnostico.cita.paciente.last_name)
            $("#medico").val(diagnostico.cita.medico.name + ' ' + diagnostico.cita.medico.last_name)
            $("#servicio").val(diagnostico.cita.servicio.servicio)
            $("#presion").val(diagnostico.triaje.presion)
            $("#temperatura").val(diagnostico.triaje.temperatura)
            $("#cardiaca").val(diagnostico.triaje.cardiaca)
            $("#saturacion").val(diagnostico.triaje.saturacion)
            $("#peso").val(diagnostico.triaje.peso)
            $("#talla").val(diagnostico.triaje.talla)
            $("#idDiagnostico").val(diagnostico.id)
            $("#idPaciente").val(diagnostico.cita.paciente.id)
            $("#defaultModal").modal('show')
        }
    </script>
@endsection
