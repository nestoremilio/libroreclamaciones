<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Reclamo N° {{ $reclamo->numero_hoja_reclamacion }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            background: #fff;
        }

        /* ── CABECERA ── */
        .header {
            background-color: #135835;
            color: #fff;
            padding: 14px 20px;
            display: table;
            width: 100%;
        }
        .header-logo {
            display: table-cell;
            vertical-align: middle;
            width: 60px;
        }
        .header-logo img {
            width: 52px;
            height: auto;
        }
        .header-text {
            display: table-cell;
            vertical-align: middle;
            padding-left: 12px;
        }
        .header-text .inst {
            font-size: 9px;
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: .85;
        }
        .header-text .title {
            font-size: 15px;
            font-weight: bold;
            margin: 3px 0 2px;
        }
        .header-text .subtitle {
            font-size: 9px;
            opacity: .8;
        }
        .header-num {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            white-space: nowrap;
        }
        .header-num .num-label {
            font-size: 8px;
            text-transform: uppercase;
            opacity: .75;
        }
        .header-num .num-value {
            font-size: 20px;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }

        /* ── ESTADO ── */
        .estado-bar {
            padding: 6px 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .estado-pendiente  { background: #fff3cd; color: #856404; border-bottom: 2px solid #ffc107; }
        .estado-en_proceso { background: #cfe2ff; color: #084298; border-bottom: 2px solid #0d6efd; }
        .estado-resuelto   { background: #d1e7dd; color: #0f5132; border-bottom: 2px solid #198754; }

        /* ── CUERPO ── */
        .body { padding: 16px 20px; }

        /* ── SECCIONES ── */
        .section { margin-bottom: 14px; }
        .section-title {
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: #135835;
            border-bottom: 1.5px solid #135835;
            padding-bottom: 4px;
            margin-bottom: 8px;
        }

        /* ── GRID 2 COLUMNAS ── */
        .row { display: table; width: 100%; margin-bottom: 4px; }
        .col-half { display: table-cell; width: 50%; vertical-align: top; padding-right: 10px; }

        .field { margin-bottom: 6px; }
        .field-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #666;
            margin-bottom: 2px;
        }
        .field-value {
            font-size: 11px;
            font-weight: bold;
            color: #111;
        }

        /* ── TIPO BADGE ── */
        .badge-tipo {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-reclamo { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        .badge-queja   { background: #f8d7da; color: #842029; border: 1px solid #f5c2c7; }

        /* ── TEXTO LARGO ── */
        .text-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-left: 3px solid #135835;
            padding: 8px 10px;
            font-size: 11px;
            line-height: 1.6;
            color: #212529;
            margin-top: 4px;
        }

        /* ── EVIDENCIA ── */
        .evidencia-box {
            background: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 4px;
            padding: 7px 10px;
            font-size: 10px;
            color: #856404;
        }

        /* ── DECLARACIONES ── */
        .check-row { margin-bottom: 4px; font-size: 10px; }
        .check-icon { color: #135835; font-weight: bold; margin-right: 5px; }

        /* ── FIRMA ── */
        .firma-section {
            margin-top: 30px;
            display: table;
            width: 100%;
        }
        .firma-col {
            display: table-cell;
            width: 33%;
            text-align: center;
            padding: 0 10px;
        }
        .firma-line {
            border-top: 1px solid #333;
            margin: 0 10px 4px;
        }
        .firma-label { font-size: 9px; color: #555; }

        /* ── PIE ── */
        .footer {
            margin-top: 20px;
            border-top: 1px solid #dee2e6;
            padding-top: 8px;
            display: table;
            width: 100%;
        }
        .footer-left  { display: table-cell; font-size: 8px; color: #888; }
        .footer-right { display: table-cell; text-align: right; font-size: 8px; color: #888; }

        .divider { border: none; border-top: 1px solid #e9ecef; margin: 10px 0; }
    </style>
</head>
<body>

    {{-- CABECERA --}}
    <div class="header">
        <div class="header-logo">
            {{-- Logo en base64 para garantizar que se vea en el PDF --}}
            <img src="{{ public_path('images/direddoc.png') }}" alt="Logo">
        </div>
        <div class="header-text">
            <div class="inst">Dirección Ejecutiva de Documentación e Identificación</div>
            <div class="title">HOJA DE RECLAMACIÓN</div>
            <div class="subtitle">DIREDDOC PNP — Libro de Reclamaciones Oficial</div>
        </div>
        <div class="header-num">
            <div class="num-label">N° de Hoja</div>
            <div class="num-value">{{ $reclamo->numero_hoja_reclamacion ?: 'S/N' }}</div>
        </div>
    </div>

    {{-- BARRA DE ESTADO --}}
    <div class="estado-bar estado-{{ $reclamo->estado }}">
        @if($reclamo->estado == 'pendiente')     ⏳ Estado: PENDIENTE DE ATENCIÓN
        @elseif($reclamo->estado == 'en_proceso') ⚙ Estado: EN PROCESO DE ATENCIÓN
        @else                                      ✔ Estado: RESUELTO
        @endif
        &nbsp;&nbsp;|&nbsp;&nbsp;
        Registrado el {{ $reclamo->created_at->format('d/m/Y \a \l\a\s H:i') }} hrs.
    </div>

    <div class="body">

        {{-- 1. DATOS DEL CIUDADANO --}}
        <div class="section">
            <div class="section-title">1. Identificación del Ciudadano</div>
            <div class="row">
                <div class="col-half">
                    <div class="field">
                        <div class="field-label">Nombres y Apellidos</div>
                        <div class="field-value">{{ $reclamo->nombres_apellidos }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Tipo y N° de Documento</div>
                        <div class="field-value">{{ $reclamo->tipo_documento }} — {{ $reclamo->numero_documento }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Domicilio</div>
                        <div class="field-value">{{ $reclamo->domicilio }}</div>
                    </div>
                </div>
                <div class="col-half">
                    <div class="field">
                        <div class="field-label">Teléfono / Celular</div>
                        <div class="field-value">{{ $reclamo->telefono ?: '—' }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Correo Electrónico</div>
                        <div class="field-value">{{ $reclamo->correo }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Autoriza Notificación por Correo</div>
                        <div class="field-value">{{ $reclamo->autoriza_notificacion_correo ? 'Sí' : 'No' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. DETALLE DEL RECLAMO --}}
        <div class="section">
            <div class="section-title">2. Detalle del Reclamo / Queja</div>

            <div class="row">
                <div class="col-half">
                    <div class="field">
                        <div class="field-label">Tipo de Registro</div>
                        <div class="field-value">
                            <span class="badge-tipo badge-{{ $reclamo->tipo_registro }}">
                                {{ strtoupper($reclamo->tipo_registro) }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-half">
                    <div class="field">
                        <div class="field-label">Dependencia / Servicio Involucrado</div>
                        <div class="field-value">{{ $reclamo->dependencia }}</div>
                    </div>
                </div>
            </div>

            <div class="field" style="margin-top:8px;">
                <div class="field-label">Detalle de los Hechos</div>
                <div class="text-box">{{ $reclamo->detalle_hechos }}</div>
            </div>

            <div class="field" style="margin-top:8px;">
                <div class="field-label">Pedido del Ciudadano</div>
                <div class="text-box">{{ $reclamo->pedido_usuario }}</div>
            </div>
        </div>

        {{-- 3. EVIDENCIA --}}
        <div class="section">
            <div class="section-title">3. Documentos Adjuntos</div>
            @if($reclamo->evidencia_pdf_path)
                <div class="evidencia-box">
                    📎 Se adjuntó un archivo PDF de sustento al momento del registro.
                    (Ver archivo adjunto en el sistema: N° {{ $reclamo->numero_hoja_reclamacion }})
                </div>
            @else
                <div class="field-value" style="color:#888; font-style:italic;">No se adjuntó evidencia.</div>
            @endif
        </div>

        {{-- 4. DECLARACIONES --}}
        <div class="section">
            <div class="section-title">4. Declaraciones del Ciudadano</div>
            <div class="check-row">
                <span class="check-icon">{{ $reclamo->acepta_politicas_privacidad ? '☑' : '☐' }}</span>
                Acepta las políticas de privacidad y el tratamiento de sus datos personales (Ley N° 29733).
            </div>
            <div class="check-row">
                <span class="check-icon">{{ $reclamo->declaracion_jurada_veracidad ? '☑' : '☐' }}</span>
                Declara bajo juramento que la información proporcionada es verídica y exacta.
            </div>
        </div>

        <hr class="divider">

        {{-- FIRMAS --}}
        <div class="firma-section">
            <div class="firma-col">
                <br><br>
                <div class="firma-line"></div>
                <div class="firma-label">Firma del Ciudadano</div>
                <div class="firma-label" style="margin-top:2px;">{{ $reclamo->nombres_apellidos }}</div>
                <div class="firma-label">DNI: {{ $reclamo->numero_documento }}</div>
            </div>
            <div class="firma-col">
                <br><br>
                <div class="firma-line"></div>
                <div class="firma-label">Recibido por</div>
                <div class="firma-label" style="margin-top:2px;">Responsable del Libro de Reclamaciones</div>
                <div class="firma-label">Sello y Firma</div>
            </div>
            <div class="firma-col">
                <br><br>
                <div class="firma-line"></div>
                <div class="firma-label">Derivado a</div>
                <div class="firma-label" style="margin-top:2px;">Área Competente</div>
                <div class="firma-label">Sello y Firma</div>
            </div>
        </div>

        {{-- PIE --}}
        <div class="footer">
            <div class="footer-left">
                DIREDDOC PNP — Libro de Reclamaciones Oficial &nbsp;|&nbsp; Generado el {{ now()->format('d/m/Y H:i') }} hrs.
            </div>
            <div class="footer-right">
                Hoja N°: {{ $reclamo->numero_hoja_reclamacion ?: 'S/N' }}
            </div>
        </div>

    </div>
</body>
</html>
