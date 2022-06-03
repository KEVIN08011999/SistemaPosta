<?php

namespace App\Http\Controllers;

use App\Models\{Medicamentos};
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamentos::all();
        return view('farmacias.medicamentos', compact('medicamentos'));
    }


    public function store(Request $request)
    {
        Medicamentos::updateOrCreate([
            'nombre' => $request->nombre,
            'precio_unidad' => $request->precio_unidad,
            'precio_empaque' => $request->precio_empaque,
            'cantidad_unidades_empaque' => $request->cantidad_unidades_empaque,
            'stock_unidades' => $request->stock_empaque * $request->cantidad_unidades_empaque,
            'stock_empaque' => $request->stock_empaque,
            'presentacion' => $request->presentacion
        ]);

        return back()->with('success', 'Medicmaneot Creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medicamentos  $medicamentos
     * @return \Illuminate\Http\Response
     */
    public function show(Medicamentos $medicamentos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicamentos  $medicamentos
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicamentos $medicamentos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedicamentosRequest  $request
     * @param  \App\Models\Medicamentos  $medicamentos
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicamentos  $medicamentos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicamentos $medicamentos)
    {
        //
    }
}
