<?php

namespace App\Http\Controllers;

use App\Models\{PagosPaciente, Servicios, User};
use Illuminate\Http\Request;

class PagosPacienteController extends Controller
{
    public function index()
    {
        $pagos = PagosPaciente::whereFechaGeneracion(date('Y-m-d'))->whereEstado(1)->with(['paciente', 'servicio'])->get();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('pagos.list', compact('pagos','servicios', 'pacientes', 'medicos'));
    }

    public function realizados()
    {
        $pagos = PagosPaciente::whereEstado(2)->with(['paciente', 'servicio'])->get();
        $servicios = Servicios::all();
        $medicos = User::whereRolId(2)->get();
        $pacientes = User::whereRolId(4)->get();
        return view('pagos.list', compact('pagos','servicios', 'pacientes', 'medicos'));
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
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        return view('pagos.view', compact('pago','servicios', 'pacientes', 'medicos'));
    }

}
