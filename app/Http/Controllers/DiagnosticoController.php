<?php

namespace App\Http\Controllers;

use App\Models\{Diagnostico};
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::where('estado', 1)->with(['cita', 'cita.medico', 'cita.paciente', 'cita.servicio', 'triaje'])->get();

        return view('diagnosticos.list', compact('diagnosticos'));
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnostico $diagnostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnostico $diagnostico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiagnosticoRequest  $request
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diagnostico  $diagnostico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnostico $diagnostico)
    {
        //
    }
}
