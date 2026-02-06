<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\LibroReclamaciones; // Aseguraremos esto luego

// Ruta Principal: Muestra el formulario
Route::get('/', function () {
    return view('reclamo');
});

// Ruta para Guardar (La lógica la haremos en el siguiente paso)
Route::post('/guardar', function (Request $request) {
    return "Aquí procesaremos el reclamo de: " . $request->nombre_completo;
})->name('guardar-reclamo');