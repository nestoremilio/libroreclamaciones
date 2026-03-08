<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Detalle del Reclamo - DIREDDOC PNP</title>
    <link rel="icon" href="{{ asset('images/direddoc.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --pnp-green: #135835;
            --pnp-green-dark: #0e4429;
            --pnp-gray: #6c757d;
            --bg-light: #f4f6f9;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar --- */
        .navbar-pnp {
            background-color: var(--pnp-green-dark);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* --- Cards --- */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card-header-pnp {
            background: linear-gradient(135deg, var(--pnp-green) 0%, var(--pnp-green-dark) 100%);
            border-radius: 12px 12px 0 0 !important;
            padding: 1.25rem 1.5rem;
        }

        .info-block {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            background-color: #f8f9fa;
            border-left: 4px solid var(--pnp-green);
            height: 100%;
        }

        .info-block .info-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--pnp-gray);
            margin-bottom: 3px;
        }

        .info-block .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #212529;
        }

        .section-header {
            color: var(--pnp-green);
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 1rem;
        }

        .detail-box {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 1.25rem;
            font-size: 0.95rem;
            line-height: 1.6;
            color: #343a40;
        }

        .badge-tipo-reclamo {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-tipo-queja {
            background-color: #cff4fc;
            color: #055160;
            border: 1px solid #b6effb;
        }

        .badge-pendiente {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .badge-atendido {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-back {
            color: white;
            font-size: 0.85rem;
            text-decoration: none;
            opacity: 0.8;
            transition: opacity 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-back:hover {
            opacity: 1;
            color: white;
        }

        .btn-attend {
            background-color: var(--pnp-green);
            color: white;
            font-weight: 700;
            padding: 10px 28px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-attend:hover {
            background-color: var(--pnp-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(19, 88, 53, 0.4);
            color: white;
        }

        .meta-pill {
            background: rgba(255,255,255,0.15);
            border-radius: 50px;
            padding: 4px 12px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        @media (max-width: 768px) {
            .navbar-brand span { font-size: 0.85rem; }
            .navbar-brand img { height: 35px !important; }
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-pnp py-2 py-md-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/direddoc.png') }}" alt="Logo PNP" style="height: 45px; width: auto;">
                <span>SISTEMA ADMINISTRATIVO - DIREDDOC</span>
            </a>

            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-block text-end lh-1">
                    <div class="text-white fw-bold" style="font-size: 0.9rem;">Administrador</div>
                    <small class="text-white-50" style="font-size: 0.75rem;">Sesión Activa</small>
                </div>
                <div class="vr text-white opacity-25 mx-2 d-none d-md-block"></div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm px-3 rounded-pill border-opacity-50">
                        <i class="bi bi-box-arrow-right me-1"></i> <span class="d-none d-sm-inline">Salir</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container py-4 py-md-5 flex-grow-1">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none" style="color: var(--pnp-green);">
                        <i class="bi bi-house me-1"></i>Bandeja
                    </a>
                </li>
                <li class="breadcrumb-item active text-muted">Detalle del Reclamo</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- Card principal --}}
                <div class="card overflow-hidden mb-4">

                    {{-- Header --}}
                    <div class="card-header-pnp text-white">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div>
                                <div class="d-flex align-items-center gap-3 flex-wrap">
                                    <h5 class="fw-bold mb-0 font-monospace">{{ $reclamo->codigo_seguimiento }}</h5>

                                    @if($reclamo->tipo_reclamo == 'reclamo')
                                        <span class="status-badge badge-tipo-reclamo">
                                            <i class="bi bi-exclamation-circle-fill"></i> Reclamo
                                        </span>
                                    @else
                                        <span class="status-badge badge-tipo-queja">
                                            <i class="bi bi-person-x-fill"></i> Queja
                                        </span>
                                    @endif

                                    @if($reclamo->estado == 'pendiente')
                                        <span class="status-badge badge-pendiente">
                                            <i class="bi bi-hourglass-split"></i> Pendiente
                                        </span>
                                    @else
                                        <span class="status-badge badge-atendido">
                                            <i class="bi bi-check-circle-fill"></i> Atendido
                                        </span>
                                    @endif
                                </div>
                                <div class="mt-2 d-flex flex-wrap gap-2">
                                    <span class="meta-pill text-white-50">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $reclamo->created_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </div>

                            @if($reclamo->evidencia)
                                <a href="{{ asset('storage/' . $reclamo->evidencia) }}" target="_blank"
                                    class="btn btn-sm btn-light text-danger fw-bold rounded-pill px-3">
                                    <i class="bi bi-file-earmark-pdf-fill me-1"></i> Ver PDF
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body p-4">

                        {{-- Sección: Ciudadano --}}
                        <div class="mb-4">
                            <div class="section-header">
                                <i class="bi bi-person-fill"></i> Datos del Ciudadano
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="info-block">
                                        <div class="info-label">Nombre Completo</div>
                                        <div class="info-value">{{ $reclamo->nombre_completo }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-block">
                                        <div class="info-label">Tipo Documento</div>
                                        <div class="info-value">{{ $reclamo->tipo_documento }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-block">
                                        <div class="info-label">N° Documento</div>
                                        <div class="info-value">{{ $reclamo->numero_documento }}</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="info-block">
                                        <div class="info-label"><i class="bi bi-geo-alt me-1"></i>Domicilio</div>
                                        <div class="info-value">{{ $reclamo->domicilio ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-block">
                                        <div class="info-label"><i class="bi bi-phone me-1"></i>Teléfono</div>
                                        <div class="info-value">{{ $reclamo->telefono }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-block">
                                        <div class="info-label"><i class="bi bi-envelope me-1"></i>Correo</div>
                                        <div class="info-value" style="font-size: 0.85rem; word-break: break-all;">{{ $reclamo->email }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Sección: Incidente --}}
                        <div class="mb-4">
                            <div class="section-header">
                                <i class="bi bi-clipboard-data-fill"></i> Sobre el Incidente
                            </div>
                            <div class="row g-3">
                                <div class="col-6 col-md-3">
                                    <div class="info-block">
                                        <div class="info-label">Bien Contratado</div>
                                        <div class="info-value text-capitalize">{{ $reclamo->tipo_bien }}</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="info-block">
                                        <div class="info-label">Monto Reclamado</div>
                                        <div class="info-value">
                                            {{ $reclamo->monto_reclamado ? 'S/ ' . number_format($reclamo->monto_reclamado, 2) : '—' }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="info-block">
                                        <div class="info-label">Descripción del Bien/Servicio</div>
                                        <div class="info-value">{{ $reclamo->descripcion_bien }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Sección: Narrativa --}}
                        <div class="mb-4">
                            <div class="section-header">
                                <i class="bi bi-chat-text-fill"></i> Detalle del Reclamo / Queja
                            </div>
                            <div class="detail-box">
                                {{ $reclamo->detalle }}
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="section-header">
                                <i class="bi bi-hand-index-thumb-fill"></i> Pedido del Ciudadano
                            </div>
                            <div class="detail-box" style="border-left: 4px solid #0d6efd;">
                                {{ $reclamo->pedido }}
                            </div>
                        </div>

                        {{-- Footer de acciones --}}
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 pt-3 border-top">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Volver a la Bandeja
                            </a>

                            @if($reclamo->estado == 'pendiente')
                                <form action="{{ route('admin.atender', $reclamo->id) }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="btn-attend"
                                        onclick="return confirm('¿Marcar este reclamo como atendido?')">
                                        <i class="bi bi-check-circle-fill"></i> Marcar como Atendido
                                    </button>
                                </form>
                            @else
                                <div class="d-flex align-items-center gap-2 text-success fw-bold">
                                    <i class="bi bi-check-circle-fill fs-5"></i>
                                    <span>Este reclamo ya fue atendido</span>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
