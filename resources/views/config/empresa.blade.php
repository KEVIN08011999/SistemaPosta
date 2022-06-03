@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informacion de la Clinica</h4>

            </div>
            <form action="{{ route('empresa.store') }}" method="post" autocomplete="off" accept-charset="UTF-8"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block mt-20" style="margin-top: 20px">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> {{ $message }} </strong>
                        </div>
                    @endif


                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Documento</label>
                                <input type="text" name="documento" value="{{ $empresa->documento }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Razonn Social</label>
                                <input type="text" name="nombre" value="{{ $empresa->nombre }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Telefono</label>
                                <input type="text" name="telefono" value="{{ $empresa->telefono }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Correo</label>
                                <input type="text" name="correo" value="{{ $empresa->correo }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Direccion</label>
                                <input type="text" name="direccion" value="{{ $empresa->direccion }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">web</label>
                                <input type="text" name="web" value="{{ $empresa->web }}" class="form-control"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" name="logo" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Logo Anterior</label>
                                <img src="/uploads/logos/{{ $empresa->logo }}" class="w-100" alt="">
                            </div>
                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="submit" value="Actualizar" class="w-100 btn btn-success">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('modales')
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

        function editarHorario(horario) {
            console.log(horario)
            var horas = horario.horario.split(' - ');

            $("#inicio").val(horas[0])
            $("#fin").val(horas[1])
            $("#idHorario").val(horario.id)
            $("#defaultModal2").modal('show')
        }
    </script>
@endsection
