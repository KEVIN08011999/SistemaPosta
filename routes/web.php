<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if(isset(Auth::user()->name))
    {
        return redirect()->route('home');
    }
    else{
        return view('welcome');
    }

})->name('index');

Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('home', [WelcomeController::class, 'home'])->name('home');


Route::group(['prefix' => 'usuarios'], function() {
    Route::get('administradores', [UserController::class, 'administradores'])->name('administradores');
    Route::get('medicos', [UserController::class, 'medicos'])->name('medicos');
    Route::get('farmaceutas', [UserController::class, 'farmaceutas'])->name('farmaceutas');
    Route::get('pacientes', [UserController::class, 'pacientes'])->name('pacientes');
    Route::post('store', [UserController::class, 'store'])->name('usuario.store');
    Route::post('update', [UserController::class, 'update'])->name('usuario.update');
});


Route::group(['prefix' => 'citas'], function () {
    Route::get('/', [CitasController::class, 'index'])->name('citas');
    Route::post('store', [CitasController::class, 'store'])->name('cita.store');
    Route::post('update', [CitasController::class, 'update'])->name('cita.update');
});


Route::group(['prefix' => 'configuraciones'], function () {
    Route::get('/', [BloquesHorariosController::class, 'index'])->name('horarios.index');
    Route::post('bloquesHorarios', [BloquesHorariosController::class, 'store'])->name('horario.store');
    Route::post('updateHorario', [BloquesHorariosController::class, 'update'])->name('horario.update');
});

Route::group(['prefix' => 'servicios'], function () {
    Route::get('/', [ServiciosController::class, 'index'])->name('servicios.index');
    Route::post('servicio', [ServiciosController::class, 'store'])->name('servicio.store');
    Route::post('updateServicio', [ServiciosController::class, 'update'])->name('servicio.update');
});


Route::group(['prefix' => 'triajes'], function () {
    Route::get('/', [TriajeController::class, 'index'])->name('triaje.index');
    Route::post('store', [TriajeController::class, 'store'])->name('triaje.store');
});
