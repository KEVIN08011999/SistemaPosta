<?php

namespace App\Http\Controllers;

use App\Models\{Medicamentos, Ventas, User, Servicios};
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    public function index()
    {
        $pacientes = User::whereRolId(4)->get();
        $medicamentos = Medicamentos::all();
        $venta = new Ventas();
        $venta->save();
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        return view('farmacias.pos', compact('medicamentos', 'pacientes', 'venta','servicios', 'pacientes', 'medicos'));
    }
}
