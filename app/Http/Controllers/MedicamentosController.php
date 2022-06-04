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

        return back()->with('success', 'Medicamento Creado con exito');
    }

    public function update(Request $request)
    {
        $medicamento =
        Medicamentos::updateOrCreate(
            ['id' => $request->idMedicamento],
            [
            'nombre' => $request->nombre,
            'precio_unidad' => $request->precio_unidad,
            'precio_empaque' => $request->precio_empaque,
            'cantidad_unidades_empaque' => $request->cantidad_unidades_empaque,
            'stock_unidades' => $request->stock_empaque * $request->cantidad_unidades_empaque,
            'stock_empaque' => $request->stock_empaque,
            'presentacion' => $request->presentacion
        ]);

        return back()->with('success', 'Medicamento Actualizado con exito');
    }


    public function get(Medicamentos $medicamento)
    {
        return $medicamento;
    }
}
