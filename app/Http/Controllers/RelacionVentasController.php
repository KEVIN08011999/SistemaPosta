<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRelacionVentasRequest;
use App\Http\Requests\UpdateRelacionVentasRequest;
use App\Models\Medicamentos;
use App\Models\RelacionVentas;
use Illuminate\Http\Request;

class RelacionVentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRelacionVentasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = Medicamentos::find($request->idProducto);
        if ($request->tipo == 1) {
            $total = $request->cantidad * $producto->precio_empaque;
        } else {
            $total = $request->cantidad * $producto->precio_unidad;
        }
        $venta = RelacionVentas::updateOrCreate(
            [
                'idVenta' => $request->idVenta,
                'idProducto' => $request->idProducto
            ],
            [
                'idVenta' => $request->idVenta,
                'idProducto' => $request->idProducto,
                'cantidad' => $request->cantidad,
                'total' => $total,
                'tipo'  => $request->tipo
            ]
        );

        $ventas = RelacionVentas::where('idVenta', $request->idVenta)->with('producto')->get();

        $html = "";
        $total= 0;

        foreach ($ventas as $venta) {
            $html .= "<tr>";
            $html .= "<td>" . $venta->producto->nombre ."(". $venta->producto->presentacion .")</td>";
            if ($venta->tipo == 1) {
                $html .= "<td>Pqt</td>";
                $html .= "<td>".$venta->producto->precio_empaque."</td>";
            }
            if ($venta->tipo == 2) {
                $html .= "<td>Und</td>";
                $html .= "<td>" . $venta->producto->precio_unidad . "</td>";
            }
            $html .= "<td>$venta->cantidad</td>";
            $html .= "<td>".$venta->total."</td>";
            $html .= "<td><i class='fa fa-trash text-danger'></i></td>";
            $html .= "</tr>";
            $total = $total + $venta->total;
        }

        return response()->json([
            'html' => $html,
            'total' => $total
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RelacionVentas  $relacionVentas
     * @return \Illuminate\Http\Response
     */
    public function show(RelacionVentas $relacionVentas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RelacionVentas  $relacionVentas
     * @return \Illuminate\Http\Response
     */
    public function edit(RelacionVentas $relacionVentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRelacionVentasRequest  $request
     * @param  \App\Models\RelacionVentas  $relacionVentas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRelacionVentasRequest $request, RelacionVentas $relacionVentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RelacionVentas  $relacionVentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(RelacionVentas $relacionVentas)
    {
        //
    }
}
