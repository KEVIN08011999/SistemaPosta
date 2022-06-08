<?php

namespace App\Http\Controllers;

use App\Models\{Empresa, Ventas, Servicios, User};
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function factura($idVenta)
    {
        $empresa = Empresa::first();
        $servicios = Servicios::all();
        $medicos = User::whereIdRol(2);
        $pacientes = User::whereIdRol(4);
        $venta = Ventas::whereId($idVenta)->with('cliente', 'detalle', 'detalle.producto')->first();


        return view('farmacias.factura', compact('empresa', 'venta', 'servicios', 'medicos', 'pacientes'));
    }

    public function update(Request $request)
    {
        $venta = Ventas::find($request->idVenta);
        $venta->idCliente = $request->idCliente;
        $venta->sub_total = $request->total;
        $venta->tipo_pago = $request->tipo_pago;
        $venta->estado = 2;
        $venta->save();

        return 200;
    }
}
