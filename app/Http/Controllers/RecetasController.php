<?php

namespace App\Http\Controllers;

use App\Models\Recetas;
use Illuminate\Http\Request;

class RecetasController extends Controller
{

    public function index()
    {
        //
    }

    public function create(Request $request)
    {

    }

    public function store(Request $request)
    {
        $receta = Recetas::create([
            'idDiagnostico' => $request->idDiagnostico,
            'idPaciente' => $request->idPaciente,
            'medicamento' => $request->medicamento,
            'presentacion' => $request->presentacion,
            'dosis' => $request->dosis,
            'duracion' => $request->duracion,
            'cantidad' => $request->cantidad,
            'estado' => 1
        ]);

        $recetas = Recetas::where('idDiagnostico', $request->idDiagnostico)->get();

        $html = "";

        foreach ($recetas as $receta) {
            $html .= "<tr>";
            $html .= "<td>$receta->medicamento</td>";
            $html .= "<td>$receta->presentacion</td>";
            $html .= "<td>$receta->dosis</td>";
            $html .= "<td>$receta->duracion</td>";
            $html .= "<td>$receta->cantidad</td>";
            $html .= "</tr>";
        }

        return $html;
    }


    public function update()
    {
        //
    }

}
