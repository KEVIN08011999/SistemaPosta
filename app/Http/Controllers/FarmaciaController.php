<?php

namespace App\Http\Controllers;

use App\Models\Medicamentos;
use App\Models\User;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    public function index()
    {
        $pacientes = User::whereRolId(4)->get();
        $medicamentos = Medicamentos::all();
        return view('farmacias.pos', compact('medicamentos', 'pacientes'));
    }
}
