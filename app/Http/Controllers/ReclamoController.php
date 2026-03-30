<?php

namespace App\Http\Controllers;

use App\Models\LibroReclamaciones;
use Illuminate\Http\Request;

class ReclamoController extends Controller
{
    public function index()
    {
        return view('reclamo');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombres_apellidos'            => 'required|string|max:200',
            'tipo_documento'               => 'required',
            'numero_documento'             => 'required|digits_between:8,12',
            'domicilio'                    => 'required',
            'telefono'                     => 'nullable|numeric|digits:9',
            'correo'                       => 'required|email',
            'tipo_registro'               => 'required|in:reclamo,queja',
            'dependencia'                  => 'required',
            'detalle_hechos'               => 'required',
            'pedido_usuario'               => 'required',
            'evidencia_pdf_path'           => 'nullable|mimes:pdf|max:5120',
        ]);

        $anio   = now()->format('Y');
        $count  = LibroReclamaciones::whereYear('created_at', $anio)->count() + 1;
        $numero = $anio . '-' . str_pad($count, 6, '0', STR_PAD_LEFT);

        $rutaEvidencia = null;
        if ($request->hasFile('evidencia_pdf_path')) {
            $rutaEvidencia = $request->file('evidencia_pdf_path')->store('evidencias', 'public');
        }

        LibroReclamaciones::create([
            'numero_hoja_reclamacion'      => $numero,
            'nombres_apellidos'            => $request->nombres_apellidos,
            'tipo_documento'               => $request->tipo_documento,
            'numero_documento'             => $request->numero_documento,
            'domicilio'                    => $request->domicilio,
            'telefono'                     => $request->telefono,
            'correo'                       => $request->correo,
            'tipo_registro'                => $request->tipo_registro,
            'dependencia'                  => $request->dependencia,
            'detalle_hechos'               => $request->detalle_hechos,
            'pedido_usuario'               => $request->pedido_usuario,
            'evidencia_pdf_path'           => $rutaEvidencia,
            'autoriza_notificacion_correo' => $request->has('autoriza_notificacion_correo') ? 1 : 0,
            'acepta_politicas_privacidad'  => 1,
            'declaracion_jurada_veracidad' => 1,
            'estado'                       => 'pendiente',
        ]);

        return back()->with('success', "Su reclamo ha sido registrado con el número: $numero");
    }
}
