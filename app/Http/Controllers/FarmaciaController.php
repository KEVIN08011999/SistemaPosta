<?php

namespace App\Http\Controllers;

use App\Models\{Medicamentos, Ventas, User};
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    public function index()
    {
        $pacientes = User::whereRolId(4)->get();
        $medicamentos = Medicamentos::all();
        $venta = new Ventas();
        $venta->save();
        return view('farmacias.pos', compact('medicamentos', 'pacientes', 'venta'));
    }
}
