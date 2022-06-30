<?php
namespace App\Http\Controllers;

use App\Models\Recetas;
use App\Models\RelacionVentas;
use App\Models\Ventas;
use Illuminate\Support\Facades\Route;

Route::get('usuario/{usuario}', [UserController::class, 'get']);
Route::get('getHorariosOcupados/{idMedico}/{fecha}', [CitasController::class, 'getOcupados']);
Route::get('validarDocumento/{document}', [UserController::class, 'validardocumento']);
Route::get('getMedicosByServcicio/{idServicio}', [UserController::class, 'getMedicosByServcicio']);
Route::post('receta', [RecetasController::class, 'store']);
Route::get('receta/{diagnostico}', [RecetasController::class, 'index']);
Route::get('medicamento/{medicamento}', [MedicamentosController::class, 'get']);
Route::post('agregarproducto', [RelacionVentasController::class, 'store']);
Route::get('eliminarVenta/{idRelacion}/{idVenta}', [RelacionVentasController::class, 'eliminar']);
Route::post('guardarVenta', [VentasController::class, 'update']);
