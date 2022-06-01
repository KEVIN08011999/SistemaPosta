<?php
namespace App\Http\Controllers;

use App\Models\Recetas;
use Illuminate\Support\Facades\Route;

Route::get('usuario/{usuario}', [UserController::class, 'get']);
Route::get('getHorariosOcupados/{idMedico}/{fecha}', [CitasController::class, 'getOcupados']);
Route::get('validarDocumento/{document}', [UserController::class, 'validardocumento']);
Route::get('getMedicosByServcicio/{idServicio}', [UserController::class, 'getMedicosByServcicio']);
Route::post('receta', [RecetasController::class, 'store']);
