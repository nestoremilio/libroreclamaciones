<?php

namespace App\Http\Controllers;

use App\Models\LibroReclamaciones; // <--- USAMOS TU MODELO CORRECTO
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ReclamoController extends Controller
{
    public function index()
    {
        return view('reclamo');
    }

    public function store(Request $request)
    {
        // 1. Validamos
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'tipo_documento' => 'required',
            'numero_documento' => 'required|numeric',
            'domicilio' => 'required',
            'telefono' => 'required|numeric',
            'email' => 'required|email',
            'tipo_bien' => 'required',
            'descripcion_bien' => 'required',
            'tipo_reclamo' => 'required',
            'detalle' => 'required',
            'pedido' => 'required',
            'evidencia' => 'nullable|mimes:pdf|max:5120', // Solo PDF, max 5MB
        ]);

        // 2. Código único
        $codigo = 'REC-' . now()->format('Ymd') . '-' . rand(1000, 9999);

        // 3. Subida del Archivo
        $rutaEvidencia = null;
        if ($request->hasFile('evidencia')) {
            $rutaEvidencia = $request->file('evidencia')->store('evidencias', 'public');
        }

        // 4. Guardar en BD usando tu modelo 'LibroReclamaciones'
        LibroReclamaciones::create([
            'codigo_seguimiento' => $codigo,
            'nombre_completo' => $request->nombre_completo,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'domicilio' => $request->domicilio,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'tipo_bien' => $request->tipo_bien,
            'monto_reclamado' => $request->monto_reclamado,
            'descripcion_bien' => $request->descripcion_bien,
            'tipo_reclamo' => $request->tipo_reclamo,
            'detalle' => $request->detalle,
            'pedido' => $request->pedido,
            'estado' => 'pendiente',
            'evidencia' => $rutaEvidencia, // Guardamos la ruta
        ]);

        return back()->with('success', "Su reclamo ha sido registrado con el código: $codigo");
    }
}