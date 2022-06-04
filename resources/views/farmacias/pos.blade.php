@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Vender</h4>
            </div>
            <div class="card-body">
                <div class="row clearfix">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Paciente</label>
                            <select name="idPaciente" class="form-control" id="idPaciente">
                                <option value="">-- SELECCIONE --</option>
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}">{{ $paciente->name }}
                                        {{ $paciente->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <form action="" id="producto">
                <div class="row clearfix">
                    <div class="col-sm-4">
                        <label for="">Producto</label>
                        <select name="idProducto" id="idProducto" onchange="medicamento()" class="form-control x-100">
                            <option value="">-- SELECCIONE --</option>
                            @foreach ($medicamentos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }} ({{ $producto->presentacion }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Tipo</label>
                        <select name="tipo" id="tipo" onchange="medicamento()" class="form-control">
                            <option value="2"> UND </option>
                            <option value="1"> PQT </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="">Precio</label>
                        <input type="text" disabled id="precio" class="form-control">
                        <input type="hidden" value="{{$venta->id}}" name="idVenta" id="idVenta" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="">Cantidad</label>
                        <input type="text" name="cantidad" id="precio" class="form-control">
                    </div>
                    </form>
                    <div class="col-md-2">
                        <label for="" class="text-white">.</label>
                        <button type="button" onclick="agregar()" class=" w-100 btn btn-success">Agregar</button>
                    </div>
                </div>


                <div class="table-responsive" style="margin-top: 20px; ">
                    <table id="example" class="table table-striped table-responsive-sm" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="data_factura">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modales')
@endsection

@section('scripts')
    <script>
        var data = ""

        function medicamento()
        {
            axios.get('/api/medicamento/'+$("#idProducto").val()).then((response) => {
                if($("#tipo").val() == 1)
                {
                    $("#precio").val(response.data.precio_empaque)
                }
                else
                {
                    $("#precio").val(response.data.precio_unidad)
                }
                this.data = response.data
            })

        }

        function agregar()
        {
            var frmData = $("#producto").serialize();

            console.log(frmData)

            axios.post('/api/agregarproducto/', frmData).then((response) => {
                $("#data_factura").html(response.data.html)
            })
        }

        // var table2 = $('#example').DataTable({
        //     createdRow: function(row, data, index) {
        //         $(row).addClass('selected')
        //     },

        //     "scrollY": "42vh",
        //     "scrollCollapse": true,
        //     "paging": false
        // });
        $("#idPaciente").select2();
        $("#idProducto").select2();
    </script>
@endsection
