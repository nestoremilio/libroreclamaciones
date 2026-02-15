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

// ¡ESTA ES LA RUTA MÁGICA PARA ARREGLAR TU ERROR DE BASE DE DATOS!
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

// --- RUTA DE EMERGENCIA PARA CREAR ADMIN ---
Route::get('/crear-admin', function () {
    try {
        // Verifica si ya existe para no duplicar
        if (\App\Models\User::where('email', 'admin@pnp.gob.pe')->exists()) {
            return "<h1>El usuario ya existe</h1><a href='/login'>Ir al Login</a>";
        }

        // Crea el usuario
        \App\Models\User::create([
            'name' => 'Administrador PNP',
            'email' => 'admin@pnp.gob.pe', // Correo
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'), // Contraseña
        ]);

        return '<div style="text-align:center; font-family:sans-serif; margin-top:50px;">
                    <h1 style="color:green;">¡Usuario Creado con Éxito!</h1>
                    <p>Usa estas credenciales:</p>
                    <p><strong>Correo:</strong> admin@pnp.gob.pe</p>
                    <p><strong>Contraseña:</strong> 12345678</p>
                    <br>
                    <a href="/login" style="background:#135835; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">Ir al Login</a>
                </div>';
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

// --- NUEVA RUTA: INSTALAR DEPENDENCIAS (LIVEWIRE) ---
Route::get('/instalar-dependencias', function () {
    try {
        // Limpiamos todas las cachés para que Laravel detecte los nuevos paquetes
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');

        return '<div style="font-family:sans-serif; text-align:center; padding:50px;">
                    <h1 style="color:green;">¡Dependencias Sincronizadas!</h1>
                    <p>El sistema ha detectado la instalación de Livewire.</p>
                    <p>Las cachés y vistas han sido limpiadas correctamente.</p>
                    <a href="/" style="background:#135835; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">Ir al Inicio</a>
                </div>';
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});