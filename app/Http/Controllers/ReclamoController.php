<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibroReclamaciones;

class ReclamoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Generar código
        $codigo = 'REC-' . date('Ymd-His');

        // 2. Preparar datos
        $datos = $request->all();
        $datos['codigo_seguimiento'] = $codigo;
        $datos['estado'] = 'pendiente';

        // 3. Guardar
        LibroReclamaciones::create($datos);

        // 4. Retornar vista de éxito (CAMBIO AQUÍ)
        return view('exito', ['codigo' => $codigo]);
    }
}