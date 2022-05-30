<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecetasRequest;
use App\Http\Requests\UpdateRecetasRequest;
use App\Models\Recetas;

class RecetasController extends Controller
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
     * @param  \App\Http\Requests\StoreRecetasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecetasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function show(Recetas $recetas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function edit(Recetas $recetas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecetasRequest  $request
     * @param  \App\Models\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecetasRequest $request, Recetas $recetas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recetas  $recetas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recetas $recetas)
    {
        //
    }
}
