<?php

namespace App\Http\Controllers;

use App\Models\{Citas, Diagnostico, User, Servicios};
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::where('estado', 1)->with(['cita', 'cita.medico', 'cita.paciente', 'cita.servicio', 'triaje'])->get();
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('diagnosticos.list', compact('diagnosticos','servicios', 'pacientes', 'medicos'));
    }


    public function store(Request $request)
    {

        $new = Diagnostico::updateOrCreate(
            [ 'id' => $request->idDiagnostico ],
            [
            'motivo' => $request->motivo,
            'antecedentes' => $request->antecedentes,
            'tiempo_enfermedad' => $request->tiempo_enfermedad,
            'alergias' => $request->alergias,
            'intervenciones' => $request->intervenciones,
            'vacunas' => $request->vacunas,
            'examen' => $request->examen,
            'diagostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'tipo_diagnostico' => $request->tipo_diagnostico,
            'estado' => 2
        ]);

        return back()->with('success', 'Diagnostico Agregado a la historia clinica');
    }


    public function historiaclinica($paciente)
    {
        $paciente = User::find($paciente);
        $citas = Citas::where('idPaciente', $paciente->id)
                        ->with(['medico', 'servicio', 'diagnostico', 'diagnostico.triaje', 'paciente'])
                        ->orderBy('id', 'desc')
                        ->get();

        return view('historias.list', compact('paciente', 'citas'));
    }


}
