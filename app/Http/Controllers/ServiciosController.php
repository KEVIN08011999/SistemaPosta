<?php

namespace App\Http\Controllers;

use App\Models\{Servicios, User};
use Illuminate\Http\Request;

class ServiciosController extends Controller
{

    public function index()
    {
        $servicios = Servicios::all();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('config.servicio', compact('servicios','servicios', 'pacientes', 'medicos'));
    }


    public function store(Request $request)
    {
        Servicios::updateOrCreate([
            'servicio' => $request->servicio
        ]);

        return back()->with('success', 'Servicio Creado / Editado con exito');
    }

    public function update(Request $request)
    {
        Servicios::updateOrCreate(
            [
                'id' => $request->idServicio
            ],
            [
                'servicio' => $request->servicio
            ]
        );

        return back()->with('success', 'Servicio Creado / Editado con exito');
    }
}
