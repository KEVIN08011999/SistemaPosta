@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"> Recibo de Pago <strong># {{ $venta->id }}</strong> <span class="float-right">
                    <strong>Estado:</strong> Pagada</span> </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <h6>Datos Del Paciente:</h6>
                        <div> <strong>{{ $venta->cliente->name }} {{ $venta->cliente->last_name }}</strong> </div>
                        <div>Documento: {{ $venta->cliente->document }}</div>
                        <div>Correo: {{ $venta->cliente->email }}</div>
                        <div>Telefono: {{ $venta->cliente->telefono }}</div>
                    </div>
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        {{-- <h6>To:</h6>
                        <div> <strong>Bob Mart</strong> </div>
                        <div>Attn: Daniel Marek</div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Email: marek@daniel.com</div>
                        <div>Phone: +48 123 456 789</div> --}}
                    </div>
                    <div
                        class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <div class="brand-logo mb-3">
                                    <img class="logo-abbr mr-2" width="30%" src="/uploads/logos/{{ $empresa->logo }}"
                                        alt="">
                                </div>
                                <span><strong class="d-block">{{ $empresa->nombre }}</strong>
                                    <strong>{{ $empresa->direccion }}</strong></span><br>
                                <small class="text-muted">{{ $empresa->telefono }} - {{ $empresa->correo }}</small>
                                <small class="text-muted">{{ $empresa->web }}</small>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Descripcion</th>
                                <th class="right">Costo Unidad</th>
                                <th class="center">Cantidad</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$i = 0}}
                            @foreach ($venta->detalle as $detalle)
                            {{$i++}}
                                <tr>
                                    <td class="center">{{$i}}</td>
                                    <td class="left strong">{{$detalle->producto->nombre}}  ({{$detalle->producto->presentacion}})</td>
                                    <td class="left">
                                        @if($detalle->tipo == 1)
                                        {{$detalle->producto->precio_empaque}}
                                        @else
                                        {{$detalle->producto->precio_unidad}}
                                        @endif
                                    </td>
                                    <td class="right">{{$detalle->cantidad}}</td>
                                    <td class="center">S/. {{ $detalle->total }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5"> </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                {{-- <tr>
                                    <td class="left"><strong>Subtotal</strong></td>
                                    {{-- <td class="right">S/. {{$pago->precio}}</td>
                                </tr> --}}
                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right"><strong>S/. {{$venta->sub_total}}</strong><br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
