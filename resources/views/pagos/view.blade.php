@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"> Recibo de Pago <strong>{{$pago->fecha_generacion}}</strong> <span class="float-right">
                    <strong>Estado:</strong> Pagada</span> </div>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <h6>Datos Del Paciente:</h6>
                        <div> <strong>{{$pago->paciente->name}} {{$pago->paciente->last_name}}</strong> </div>
                        <div>Documento: {{$pago->paciente->document}}</div>
                        <div>Correo: {{$pago->paciente->email}}</div>
                        <div>Telefono: {{$pago->paciente->telefono}}</div>
                    </div>
                    {{-- <div class="mt-4 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <h6>To:</h6>
                        <div> <strong>Bob Mart</strong> </div>
                        <div>Attn: Daniel Marek</div>
                        <div>43-190 Mikolow, Poland</div>
                        <div>Email: marek@daniel.com</div>
                        <div>Phone: +48 123 456 789</div>
                    </div> --}}
                    {{-- <div
                        class="mt-4 col-xl-6 col-lg-6 col-md-12 col-sm-12 d-flex justify-content-lg-end justify-content-md-center justify-content-xs-start">
                        <div class="row align-items-center">
                            <div class="col-sm-9">
                                <div class="brand-logo mb-3">
                                    <img class="logo-abbr mr-2" src="./images/logo.png" alt="">
                                    <img class="logo-compact" src="./images/logo-text.png" alt="">
                                </div>
                                <span>Please send exact amount: <strong class="d-block">0.15050000 BTC</strong>
                                    <strong>1DonateWffyhwAjskoEwXt83pHZxhLTr8H</strong></span><br>
                                <small class="text-muted">Current exchange rate 1BTC = $6590 USD</small>
                            </div>
                            <div class="col-sm-3 mt-3"> <img src="images/qr.png" class="img-fluid width110"> </div>
                        </div>
                    </div> --}}
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
                            <tr>
                                <td class="center">1</td>
                                <td class="left strong">Servicios de : {{$pago->servicio->servicio}}</td>
                                <td class="left">S/. {{$pago->precio}}</td>
                                <td class="right">1</td>
                                <td class="center">S/. {{$pago->precio}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5"> </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left"><strong>Subtotal</strong></td>
                                    <td class="right">S/. {{$pago->precio}}</td>
                                </tr>
                                <tr>
                                    <td class="left"><strong>Total</strong></td>
                                    <td class="right"><strong>S/. {{$pago->precio}}</strong><br>
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
