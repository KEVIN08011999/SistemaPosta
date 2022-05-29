@extends('layouts.app')

@section('contenidos')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Bienvenido: {{ Auth::user()->name }} {{ Auth::user()->last_name }}</h2>
            </div>
            <div class="card-body">

                <p>Este es tu panel de administacion.</p>

            </div>
        </div>
    </div>
@endsection

