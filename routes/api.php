<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('usuario/{usuario}', [UserController::class, 'get']);
Route::get('getHorariosOcupados/{idMedico}/{fecha}', [CitasController::class, 'getOcupados']);
