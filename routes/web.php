<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReclamoController;

// Ruta Principal: Muestra el formulario
Route::get('/', function () {
    return view('reclamo');
});

// Ruta para Guardar: Manda los datos al Controlador
Route::post('/guardar', [ReclamoController::class, 'store'])->name('guardar-reclamo');