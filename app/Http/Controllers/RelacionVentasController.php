<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRelacionVentasRequest;
use App\Http\Requests\UpdateRelacionVentasRequest;
use App\Models\RelacionVentas;

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
    public function store(StoreRelacionVentasRequest $request)
    {
        //
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
