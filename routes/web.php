<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // Importante para ejecutar comandos
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
    Route::delete('/admin/reclamo/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

// --- RUTAS DE MANTENIMIENTO ---

Route::get('/limpiar', function () {
    Artisan::call('optimize:clear');
    return '¡Sistema limpio y actualizado!';
});

// ¡ESTA ES LA RUTA MÁGICA PARA ARREGLAR TU ERROR!
Route::get('/actualizar-bd', function () {
    try {
        // Esto borra la tabla vieja y la crea de nuevo con la columna 'evidencia'
        Artisan::call('migrate:refresh --force');
        
        // Esto crea el enlace para que los archivos PDF sean públicos
        Artisan::call('storage:link');
        
        return '<div style="font-family:sans-serif; text-align:center; padding:50px;">
                    <h1 style="color:green;">¡ÉXITO! Base de Datos Actualizada</h1>
                    <p>La columna "evidencia" ha sido creada correctamente.</p>
                    <p>El enlace de almacenamiento (storage:link) también se ha generado.</p>
                    <a href="/" style="background:#135835; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">Volver al Formulario</a>
                </div>';
    } catch (\Exception $e) {
        return '<h1>Error:</h1>' . $e->getMessage();
    }
});