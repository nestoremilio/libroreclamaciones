<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReclamoController;
use App\Http\Controllers\LoginController; // Nuevo
use App\Http\Controllers\AdminController; // Nuevo

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
});
// --- BORRAR ESTO DESPUÉS DE USAR ---
Route::get('/crear-admin-emergencia', function () {
    // 1. Verificar si ya existe
    if (\App\Models\User::where('email', 'admin@pnp.gob.pe')->exists()) {
        return "El usuario Admin YA existe. Intenta resetear la clave si no entras.";
    }

    // 2. Crear el usuario
    \App\Models\User::create([
        'name' => 'Administrador',
        'email' => 'admin@pnp.gob.pe',
        'password' => \Illuminate\Support\Facades\Hash::make('sistemas2026')
    ]);

    return "¡Usuario Creado! Ahora ve al login e intenta entrar.";
});