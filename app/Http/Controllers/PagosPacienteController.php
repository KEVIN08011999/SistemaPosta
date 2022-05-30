<?php

namespace App\Http\Controllers;

use App\Models\{PagosPaciente};
use Illuminate\Http\Request;

class PagosPacienteController extends Controller
{
    public function index()
    {
        $pagos = PagosPaciente::whereFechaGeneracion(date('Y-m-d'))->whereEstado(1)->with(['paciente', 'servicio'])->get();
        return view('pagos.list', compact('pagos'));
    }

    public function realizados()
    {
        $pagos = PagosPaciente::whereFechaGeneracion(date('Y-m-d'))->whereEstado(2)->with(['paciente', 'servicio'])->get();
        return view('pagos.list', compact('pagos'));
    }

    public function store(Request $request)
    {
        $pago = PagosPaciente::whereId($request->idPago)
            ->update([
            'precio' => $request->precio,
            'observacion' => $request->observacion,
            'metodoPago' => $request->metodo_pago,
            'estado' => 2,
            'idPaciente' => $request->idPaciente
            ]);

        return back()->with('success', 'Pago Guardado con exito');
    }

    public function view( $idPago)
    {
        $pago = PagosPaciente::whereId($idPago)->with(['paciente', 'servicio'])->first();

        return view('pagos.view', compact('pago'));
    }

}
