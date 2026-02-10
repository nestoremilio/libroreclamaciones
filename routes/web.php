<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;

// --- PÚBLICO ---
Route::get('/', function () {
    return view('reclamo');
});
Route::post('/guardar', [ReclamoController::class, 'store'])->name('guardar-reclamo');

// --- AUTENTICACIÓN ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- PANEL ADMINISTRATIVO (Protegido) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reclamo/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::post('/admin/reclamo/{id}/atender', [AdminController::class, 'atender'])->name('admin.atender');
<<<<<<< HEAD
=======

    // ESTA ES LA RUTA NUEVA PARA EL BOTÓN DE BORRAR:
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
    Route::delete('/admin/reclamo/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});