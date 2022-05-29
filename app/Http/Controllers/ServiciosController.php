<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{

    public function index()
    {
        $servicios = Servicios::all();
        return view('config.servicio', compact('servicios'));
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
