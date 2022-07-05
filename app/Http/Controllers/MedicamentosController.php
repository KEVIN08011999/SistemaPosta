<?php

namespace App\Http\Controllers;

use App\Models\{Medicamentos, Servicios, User};
use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamentos::all();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('farmacias.medicamentos', compact('medicamentos','servicios', 'pacientes', 'medicos'));
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
