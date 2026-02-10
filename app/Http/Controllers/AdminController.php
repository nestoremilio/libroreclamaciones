<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


    // Eliminar un reclamo
    public function destroy($id)
    {
        $reclamo = LibroReclamaciones::findOrFail($id);
        $reclamo->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Reclamo eliminado correctamente');

    // --- NUEVA FUNCIÓN: ELIMINAR RECLAMO ---
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