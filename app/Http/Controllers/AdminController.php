<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\LibroReclamaciones;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;

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
        $reclamo->estado = 'atendido';
        $reclamo->save();

        return redirect()->route('admin.dashboard')->with('success', 'Reclamo marcado como atendido correctamente.');
    }

    // Ver evidencia PDF
    public function verEvidencia($id)
    {
        $reclamo = LibroReclamaciones::findOrFail($id);

        if (!$reclamo->evidencia_pdf_path || !Storage::disk('public')->exists($reclamo->evidencia_pdf_path)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file(Storage::disk('public')->path($reclamo->evidencia_pdf_path), [
            'Content-Type' => 'application/pdf',
        ]);
    }

    // Descargar reporte PDF del reclamo (con evidencia fusionada al final)
    public function descargarReporte($id)
    {
        $reclamo  = LibroReclamaciones::findOrFail($id);
        $filename = 'Reclamo_' . ($reclamo->numero_hoja_reclamacion ?? $id) . '.pdf';

        // 1. Generar el reporte base con dompdf
        $reporteContenido = Pdf::loadView('admin.reporte-pdf', compact('reclamo'))
                              ->setPaper('a4', 'portrait')
                              ->output();

        // 2. Si no hay evidencia, devolver solo el reporte
        $tieneEvidencia = $reclamo->evidencia_pdf_path
                       && Storage::disk('public')->exists($reclamo->evidencia_pdf_path);

        if (!$tieneEvidencia) {
            return response($reporteContenido, 200, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        }

        // 3. Fusionar el reporte con la evidencia usando FPDI
        try {
            $evidenciaPath = Storage::disk('public')->path($reclamo->evidencia_pdf_path);

            // Guardar reporte en archivo temporal
            $tmpReporte = tempnam(sys_get_temp_dir(), 'rpt_') . '.pdf';
            file_put_contents($tmpReporte, $reporteContenido);

            $fpdi = new Fpdi();
            $fpdi->SetAutoPageBreak(false);

            // Agregar páginas del reporte
            $totalReporte = $fpdi->setSourceFile($tmpReporte);
            for ($p = 1; $p <= $totalReporte; $p++) {
                $tpl  = $fpdi->importPage($p);
                $size = $fpdi->getTemplateSize($tpl);
                $fpdi->AddPage($size['orientation'] ?? 'P', [$size['width'], $size['height']]);
                $fpdi->useTemplate($tpl, 0, 0, $size['width'], $size['height']);
            }

            // Agregar separador visual antes de la evidencia
            $fpdi->AddPage('P', [210, 297]);
            $fpdi->SetFont('Helvetica', 'B', 13);
            $fpdi->SetTextColor(19, 88, 53); // verde institucional
            $fpdi->SetY(130);
            $fpdi->Cell(0, 10, 'EVIDENCIA ADJUNTA POR EL CIUDADANO', 0, 1, 'C');
            $fpdi->SetFont('Helvetica', '', 10);
            $fpdi->SetTextColor(100, 100, 100);
            $fpdi->Cell(0, 8, 'Hoja de Reclamacion N° ' . ($reclamo->numero_hoja_reclamacion ?? $id), 0, 1, 'C');

            // Agregar páginas de la evidencia
            $totalEvidencia = $fpdi->setSourceFile($evidenciaPath);
            for ($p = 1; $p <= $totalEvidencia; $p++) {
                $tpl  = $fpdi->importPage($p);
                $size = $fpdi->getTemplateSize($tpl);
                $fpdi->AddPage($size['orientation'] ?? 'P', [$size['width'], $size['height']]);
                $fpdi->useTemplate($tpl, 0, 0, $size['width'], $size['height']);
            }

            @unlink($tmpReporte);

            return response($fpdi->Output('S'), 200, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);

        } catch (\Exception $e) {
            // Si la fusión falla (PDF incompatible), devolver solo el reporte
            @unlink($tmpReporte ?? '');
            return response($reporteContenido, 200, [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        }
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