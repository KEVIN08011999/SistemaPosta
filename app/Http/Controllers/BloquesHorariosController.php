<?php

namespace App\Http\Controllers;

use App\Models\{BloquesHorarios, User, Servicios};
use Illuminate\Http\Request;

class BloquesHorariosController extends Controller
{
    public function index()
    {
        $horarios = BloquesHorarios::all();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('config.horarios', compact('horarios','servicios', 'pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $horario = BloquesHorarios::create([
            'horario' => $request->inicio. " - ".$request->fin
        ]);

        return back()->with('success', 'Horario Creado con exito');
    }

    public function update(Request $request)
    {
        BloquesHorarios::updateOrCreate([
            'id' => $request->idHorario
        ],
        [
            'horario' => $request->inicio . " - " . $request->fin
        ]);

        return back()->with('success', 'Horario Actualizado con exito');
    }
}
