@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Medicamentos</h4>

                <button class="btn btn-success pull-right" data-toggle="modal" data-target="#defaultModal">
                <i class="flaticon-381-plus"></i> Agregar Medicamento </button>
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
                            <th>Medicamento (Presentacion)</th>
                            <th>Stock Empaques (Unidades)</th>
                            <th>Precio Empaques (Unidades)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicamentos as $medicamento)
                            <tr>
                                <td>{{ $medicamento->nombre }} ({{ $medicamento->presentacion }}) </td>
                                <td>{{ $medicamento->precio_empaque }} ({{ $medicamento->precio_unidad }})</td>
                                <td>{{ $medicamento->stock_empaque }} ({{ $medicamento->stock_unidades }})</td>
                                <td style="font-size: 25px">
                                    <i class="fa fa-edit text-success" onclick="editarMedicamento({{$medicamento}})"></i>
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
                    <h4 class="title" id="defaultModalLabel">Crear Medicamento</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('farmacia.medicamentos.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Cantidad Empaque</label>
                                    <input type="text" name="cantidad_unidades_empaque" id="cantidad" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Stock Empaques</label>
                                    <input type="text" name="stock_empaque" onblur="calcularCantidad()" id="empaques" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Stock Unidades</label>
                                    <input type="text" disabled  name="fin" id="unidades" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Precio Empaques</label>
                                    <input type="text" name="precio_empaque"class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Precio Unidades</label>
                                    <input type="text" name="precio_unidad" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Presentacion</label>
                                    <input type="text" name="presentacion"class="form-control" placeholder="">
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
                    <h4 class="title" id="defaultModalLabel">Editar Medicamento</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('farmacia.medicamentos.update') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="nombre" required id="nombreEdit" class="form-control" placeholder="">
                                    <input type="hidden" name="idMedicamento" id="idEdit" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Cantidad Empaque</label>
                                    <input type="text" name="cantidad_unidades_empaque" required id="cantidadEdit" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Stock Empaques</label>
                                    <input type="text" name="stock_empaque" required onblur="calcularCantidad2()" id="empaquesEdit" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Stock Unidades</label>
                                    <input type="text"  name="stock_unidades" id="unidadesEdit" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Precio Empaques</label>
                                    <input type="text" name="precio_empaque" required id="precioEmpaqueEdit" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Precio Unidades</label>
                                    <input type="text" name="precio_unidad" required id="precioUnidadEdit" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Presentacion</label>
                                    <input type="text" name="presentacion" required id="presentacionEdit" class="form-control" placeholder="">
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

        function calcularCantidad()
        {
            empaque = $("#empaques").val()
            cantidad = $("#cantidad").val()

            $("#unidades").val(empaque * cantidad)
        }

        function calcularCantidad2()
        {
            empaque = $("#empaquesEdit").val()
            cantidad = $("#cantidadEdit").val()

            $("#unidadesEdit").val(empaque * cantidad)
        }

        function editarMedicamento(medicamento)
        {
            $('#nombreEdit').val(medicamento.nombre)
            $('#idEdit').val(medicamento.id)
            $('#cantidadEdit').val(medicamento.cantidad_unidades_empaque)
            $('#empaquesEdit').val(medicamento.stock_empaque)
            $('#unidadesEdit').val(medicamento.stock_unidades)
            $('#precioEmpaqueEdit').val(medicamento.precio_empaque)
            $('#precioUnidadEdit').val(medicamento.precio_unidad)
            $('#presentacionEdit').val(medicamento.presentacion)
            $("#defaultModal2").modal('show')
        }
    </script>
@endsection
