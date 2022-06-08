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
                            <select name="idPaciente" class="form-control" id="idPaciente2">
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
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}
                                        ({{ $producto->presentacion }})
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
                            <input type="hidden" value="{{ $venta->id }}" name="idVenta" id="idVenta"
                                class="form-control">
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

                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align: right; font-size: 20px" >Total</td>
                            <td id="total">S/ 0</td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right; font-size: 20px" >
                                <button onclick="cobrar()" class="w-100 btn btn-success">Cobrar</button>
                            </td>
                        </tr>
                    </tfoot>
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
                    <h4 class="title" id="defaultModalLabel">Cobrar</h4>
                </div>
                <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tipo de Pago</label>
                                    <select name="" class="form-control" onchange="mostrar()" id="tipopago">
                                        <option value="">SELECCIONE</option>
                                        <option value="1">EFECTIVO</option>
                                        <option value="2">TARJETA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <label for="">Total</label>
                                <input type="text" class="form-control" disabled id="totalmdal">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <label for="">Paga con</label>
                                <input type="text" onblur="calcular()" class="form-control" disabled id="monto">
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <label for="">Vuelto</label>
                                <input type="text" class="form-control" disabled id="vuelto">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CERRAR</button>
                    <button type="button" onclick="guardarVenta()" class="btn btn-success btn-round waves-effect">GUARDAR</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var data = ""
        var total = ""



        function medicamento() {
            axios.get('/api/medicamento/' + $("#idProducto").val()).then((response) => {
                if ($("#tipo").val() == 1) {
                    $("#precio").val(response.data.precio_empaque)
                } else {
                    $("#precio").val(response.data.precio_unidad)
                }
                this.data = response.data
                $("#idProducto").val()
            })

        }

        function agregar() {
            var frmData = $("#producto").serialize();

            console.log(frmData)

            axios.post('/api/agregarproducto/', frmData).then((response) => {
                console.log(response.data)
                $("#data_factura").html(response.data.html)
                $("#total").html('S/' +response.data.total)
                this.total = response.data.total
                $("#producto")[0].reset();
            })
        }

        function cobrar()
        {
            $("#defaultModal").modal('show')
            $("#totalmdal").val('S/' +this.total)
        }

        function mostrar()
        {
            if($("#tipopago").val() == 1)
            {
                $("#monto").attr('disabled', false)
            }
        }

        function calcular()
        {
            monto = $("#monto").val()
            valor = monto - this.total
            $("#vuelto").val(valor)
        }

        function guardarVenta()
        {
            const data = {
                idCliente : $("#idPaciente2").val(),
                total : this.total,
                tipo_pago: $("#tipopago").val(),
                idVenta: $("#idVenta").val()
            }

            axios.post('/api/guardarVenta', data).then((response) => {
                if(response.data == 200)
                {
                    window.location.href = "/farmacia/ventas";
                }
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
        $("#idPaciente2").select2();
        $("#idProducto").select2();
    </script>
@endsection
