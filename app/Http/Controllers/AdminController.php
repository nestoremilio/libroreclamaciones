<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LibroReclamaciones;

class AdminController extends Controller
{
    // Ver lista de reclamos
    public function index()
    {
        $reclamos = LibroReclamaciones::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('reclamos'));
    }

    // Ver detalle de un reclamo
    public function show($id)
    {
        $reclamo = LibroReclamaciones::findOrFail($id);
        return view('admin.show', compact('reclamo'));
    }

    // Marcar como ATENDIDO
    public function atender($id)
    {
        $reclamo = LibroReclamaciones::findOrFail($id);
        $reclamo->estado = 'Atendido';
        $reclamo->save();

        return redirect()->route('admin.dashboard')->with('success', 'Reclamo marcado como atendido correctamente.');
    }

    // Ver evidencia PDF
    public function verEvidencia($id)
    {
        $reclamo = LibroReclamaciones::findOrFail($id);

        if (!$reclamo->evidencia || !Storage::disk('public')->exists($reclamo->evidencia)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file(Storage::disk('public')->path($reclamo->evidencia), [
            'Content-Type' => 'application/pdf',
        ]);
    }

    // Eliminar un reclamo (SOLO UNA VEZ)
    public function destroy($id)
    {
        // 1. Buscar el reclamo (si no existe, falla automáticamente)
        $reclamo = LibroReclamaciones::findOrFail($id);

        // 2. Eliminarlo de la base de datos
        $reclamo->delete();

        // 3. Regresar al dashboard con mensaje de éxito
        return redirect()->route('admin.dashboard')->with('success', 'Reclamo eliminado correctamente.');
    }
}