<?php

namespace App\Http\Controllers;

use App\Models\{Citas, Diagnostico, Empresa};
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function receta($cita)
    {
        $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'diagnostico', 'diagnostico.recetas'])->first();
        $empresa = Empresa::first();
        $ruta = public_path() . '/uploads/logos/' . $empresa->logo;


        $pdf = \PDF::loadView('pdfs.receta', compact('recetas', 'ruta', 'empresa'));

        return $pdf->download( 'Receta - Paciente: ' . $recetas->paciente->name .' '. $recetas->paciente->last_name . '.pdf');
    }

    public function diagnostico($cita)
    {
        $recetas = Citas::whereId($cita)->with(['paciente', 'medico', 'servicio', 'diagnostico', 'diagnostico.recetas'])->first();
        $empresa = Empresa::first();
        $ruta = public_path() . '/uploads/logos/' . $empresa->logo;

        //return view('pdfs.diagnostico', compact('recetas', 'ruta', 'empresa'));

        $pdf = \PDF::loadView('pdfs.diagnostico', compact('recetas', 'ruta', 'empresa'));

        return $pdf->download('Diagnostico - Paciente: ' . $recetas->paciente->name . ' ' . $recetas->paciente->last_name . '.pdf');
    }
}
