<?php

namespace App\Http\Controllers;

use App\Models\{Servicios, User};
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function home()
    {
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('home', compact('servicios', 'medicos', 'pacientes'));
    }
}
