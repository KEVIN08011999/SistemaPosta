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
                                    <option value="{{ $paciente->id }}">{{ $paciente->name }} {{ $paciente->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive" style="margin-top: 20px; width: 100%">
                    <table id="example" class="display min-w850">
                        <thead>
                            <tr>
                                <th>Medicamento</th>
                                <th>Despache</th>
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
        $("#idPaciente").select2();


    </script>
@endsection
