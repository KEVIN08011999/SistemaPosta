<?php

namespace App\Http\Controllers;

use App\Models\{Citas, Diagnostico, Triaje};
use Illuminate\Http\Request;

class TriajeController extends Controller
{
    public function index()
    {
        $citas = Citas::whereEstado(1)->whereFecha(date('Y-m-d'))->with(['medico', 'paciente', 'horario', 'servicio'])->get();
        return view('triajes.list', compact('citas'));
    }

    public function store(Request $request)
    {

       $triaje = Triaje::create([
            'idCita' => $request->idCita,
            'presion' => $request->presion,
            'temperatura' => $request->temperatura,
            'cardiaca' => $request->cardiaca,
            'saturacion' => $request->saturacion,
            'peso' => $request->peso,
            'talla' => $request->talla
        ]);

        $paciente =  Citas::whereId($request->idCita)->with('paciente')->first();

        Diagnostico::create([
            'idCita' => $request->idCita,
            'idTriaje' => $triaje->id,
            'idPaciente' => $paciente->paciente->id
        ]);

        $cita = Citas::find($request->idCita);
        $cita->estado = 2;
        $cita->save();

        return back()->with('success', 'Triaje Guardado Correctamente, el paciente espera por Atencion');
    }


}
