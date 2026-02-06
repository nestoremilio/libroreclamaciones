<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroReclamaciones; // Importamos el Modelo

class ReclamoController extends Controller
{
    // Función para guardar el reclamo
    public function store(Request $request)
    {
        // 1. Generar un código único (Ej: REC-20260205-1030)
        $codigo = 'REC-' . date('Ymd-His');

        // 2. Preparar los datos
        $datos = $request->all();
        $datos['codigo_seguimiento'] = $codigo;
        $datos['estado'] = 'pendiente';

        // 3. Guardar en la Base de Datos
        LibroReclamaciones::create($datos);

        // 4. Mostrar mensaje de éxito (Por ahora simple)
        return "<h1>¡Reclamo Registrado Exitosamente!</h1>
                <p>Su código de seguimiento es: <strong>$codigo</strong></p>
                <p>Guarde este código para futuras consultas.</p>
                <a href='/'>Volver al inicio</a>";
    }
}