<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Panel Administrativo - DIREDDOC PNP</title>
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.5px;
            white-space: normal;
        }

        /* --- Stat Cards --- */
        .stat-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            position: relative;
            background: white;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .stat-card .icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: var(--pnp-gray);
            margin-top: 4px;
        }

        .stat-card .watermark {
            position: absolute;
            right: -10px;
            bottom: -15px;
            font-size: 5rem;
            opacity: 0.07;
            line-height: 1;
        }

        /* --- Table Card --- */
        .table-card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .table-card .card-header {
            background: white;
            border-bottom: 2px solid #f0f0f0;
            padding: 1.1rem 1.5rem;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #6c757d;
            font-weight: 700;
            border-bottom: 2px solid #e9ecef;
            padding: 0.85rem 1rem;
            text-transform: uppercase;
            font-size: 0.72rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: background 0.15s;
        }

        .table tbody tr:hover {
            background-color: #f8fffe;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 0.85rem 1rem;
            color: #212529;
            font-size: 0.88rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* --- Badges --- */
        .badge-status {
            padding: 5px 11px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 0.7rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }

        .status-pendiente { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .status-atendido  { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }
        .status-reclamo   { background-color: #fde8e8; color: #842029; border: 1px solid #f5c2c7; }
        .status-queja     { background-color: #cff4fc; color: #055160; border: 1px solid #b6effb; }

        /* --- Action Buttons --- */
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-view   { background-color: #e7f1ff; color: #0d6efd; border: none; }
        .btn-view:hover { background-color: #0d6efd; color: white; }

        .btn-pdf    { background-color: #ffeaea; color: #dc3545; border: none; }
        .btn-pdf:hover { background-color: #dc3545; color: white; }

        .btn-delete { background-color: #f8d7da; color: #dc3545; border: none; }
        .btn-delete:hover { background-color: #dc3545; color: white; }

        /* --- Responsive --- */
        @media (max-width: 768px) {
            .navbar-brand span { font-size: 0.82rem; }
            .navbar-brand img  { height: 35px !important; }
            .user-info-desktop { display: none !important; }
            h2 { font-size: 1.4rem; }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-pnp py-2 py-md-3 sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('images/direddoc.png') }}" alt="Logo PNP" style="height: 45px; width: auto;">
                <span>SISTEMA ADMINISTRATIVO - DIREDDOC</span>
            </a>

            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-flex align-items-center gap-2 user-info-desktop">
                    <div class="rounded-circle bg-white bg-opacity-10 d-flex align-items-center justify-content-center text-white"
                        style="width:36px;height:36px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="text-end lh-1">
                        <div class="text-white fw-bold" style="font-size: 0.88rem;">Administrador</div>
                        <small class="text-white-50" style="font-size: 0.72rem;">Sesión Activa</small>
                    </div>
                </div>
                <div class="vr text-white opacity-25 mx-1 d-none d-md-block"></div>
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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Encabezado de página --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--pnp-green-dark);">
                    <i class="bi bi-inbox-fill me-2" style="color: var(--pnp-green);"></i>Bandeja de Reclamaciones
                </h2>
                <p class="text-muted mb-0 small">Gestión y seguimiento de reclamos ciudadanos · {{ now()->format('d/m/Y') }}</p>
            </div>
        </div>

        {{-- Tarjetas de estadísticas --}}
        <div class="row g-3 mb-4">
            {{-- Total --}}
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-number" style="color: var(--pnp-green);">{{ $reclamos->count() }}</div>
                            <div class="stat-label">Total</div>
                        </div>
                        <div class="icon-wrap" style="background:#e8f5e9;">
                            <i class="bi bi-files" style="color: var(--pnp-green);"></i>
                        </div>
                    </div>
                    <div class="watermark"><i class="bi bi-files"></i></div>
                </div>
            </div>

            {{-- Pendientes --}}
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-number text-warning">{{ $reclamos->where('estado', 'pendiente')->count() }}</div>
                            <div class="stat-label">Pendientes</div>
                        </div>
                        <div class="icon-wrap" style="background:#fff8e1;">
                            <i class="bi bi-hourglass-split text-warning"></i>
                        </div>
                    </div>
                    <div class="watermark"><i class="bi bi-hourglass-split"></i></div>
                </div>
            </div>

            {{-- Atendidos --}}
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-number text-success">{{ $reclamos->where('estado', 'Atendido')->count() }}</div>
                            <div class="stat-label">Atendidos</div>
                        </div>
                        <div class="icon-wrap" style="background:#e8f5e9;">
                            <i class="bi bi-check-circle-fill text-success"></i>
                        </div>
                    </div>
                    <div class="watermark"><i class="bi bi-check-circle-fill"></i></div>
                </div>
            </div>

            {{-- Este mes --}}
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-number text-info">
                                {{ $reclamos->where('created_at', '>=', now()->startOfMonth())->count() }}
                            </div>
                            <div class="stat-label">Este Mes</div>
                        </div>
                        <div class="icon-wrap" style="background:#e3f2fd;">
                            <i class="bi bi-calendar-month text-info"></i>
                        </div>
                    </div>
                    <div class="watermark"><i class="bi bi-calendar-month"></i></div>
                </div>
            </div>
        </div>

        {{-- Tabla --}}
        <div class="card table-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="fw-bold" style="color: var(--pnp-green-dark);">
                    <i class="bi bi-list-ul me-2"></i>Listado de Reclamos
                </div>
                <small class="text-muted">{{ $reclamos->count() }} registro(s)</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Fecha</th>
                                <th style="width: 155px;">Código</th>
                                <th>Ciudadano</th>
                                <th style="width: 110px;">Documento</th>
                                <th style="width: 95px;">Tipo</th>
                                <th style="width: 110px;">Estado</th>
                                <th class="text-end pe-4" style="width: 130px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reclamos as $reclamo)
                                <tr>
                                    <td>
                                        <div class="text-muted small fw-medium" style="font-size: 0.8rem;">
                                            <i class="bi bi-calendar3 me-1"></i>{{ $reclamo->created_at->format('d/m/Y') }}
                                        </div>
                                        <div class="text-muted" style="font-size: 0.7rem;">
                                            {{ $reclamo->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-bold font-monospace"
                                            style="font-size: 0.72rem; padding: 5px 8px;">
                                            {{ $reclamo->codigo_seguimiento }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark text-truncate" style="max-width: 200px;">
                                            {{ $reclamo->nombre_completo }}
                                        </div>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            {{ $reclamo->email }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $reclamo->tipo_documento }}</span><br>
                                        <span class="fw-semibold">{{ $reclamo->numero_documento }}</span>
                                    </td>
                                    <td>
                                        @if($reclamo->tipo_reclamo == 'reclamo')
                                            <span class="badge-status status-reclamo">
                                                <i class="bi bi-exclamation-circle-fill"></i> Reclamo
                                            </span>
                                        @else
                                            <span class="badge-status status-queja">
                                                <i class="bi bi-person-x-fill"></i> Queja
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($reclamo->estado == 'pendiente')
                                            <span class="badge-status status-pendiente">
                                                <i class="bi bi-hourglass-split"></i> Pendiente
                                            </span>
                                        @else
                                            <span class="badge-status status-atendido">
                                                <i class="bi bi-check-circle-fill"></i> Atendido
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex justify-content-end gap-1">
                                            @if($reclamo->evidencia)
                                                <a href="{{ asset('storage/' . $reclamo->evidencia) }}"
                                                    target="_blank"
                                                    class="btn-action btn-pdf"
                                                    title="Ver PDF adjunto">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.show', $reclamo->id) }}"
                                                class="btn-action btn-view"
                                                title="Ver detalle">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            <form action="{{ route('admin.destroy', $reclamo->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete"
                                                    onclick="return confirm('¿Confirma eliminar este registro permanentemente?');"
                                                    title="Eliminar">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                        <div class="fw-semibold">No hay reclamos registrados</div>
                                        <small>Los nuevos reclamos aparecerán aquí automáticamente</small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <footer class="text-center py-3 mt-auto">
        <small class="text-muted">&copy; Desarrollado por UNITIC-DIREDDOC PNP &nbsp;·&nbsp; {{ now()->year }}</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
