<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones - DIREDDOC PNP</title>
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

        .navbar-brand {
            font-weight: 700;
            font-size: 1rem; /* Ajustado para móviles */
            letter-spacing: 0.5px;
            white-space: normal; /* Permite que el texto baje si es necesario */
        }

        /* --- Cards & Widgets --- */
        .card {
            border: none;
            border-top: 5px solid var(--pnp-green);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stat-card {
            overflow: hidden;
            position: relative;
            background: white;
        }

        .stat-card .icon-bg {
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 5rem;
            opacity: 0.1;
            transform: rotate(-15deg);
            color: var(--pnp-green);
        }

        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--pnp-green);
            line-height: 1;
        }

        /* --- Table --- */
        .table-card {
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.75rem; /* Texto más compacto */
            white-space: nowrap; /* Títulos en una línea */
        }

        .table tbody td {
            vertical-align: middle;
            padding: 1rem;
            color: #212529;
            font-size: 0.9rem;
            white-space: nowrap; /* Evita que la tabla se rompa hacia abajo */
        }

        /* --- Badges & Buttons --- */
        .badge-status {
            padding: 6px 10px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.7rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .status-pendiente { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .status-atendido { background-color: #d1e7dd; color: #0f5132; border: 1px solid #badbcc; }

        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s;
            margin-left: 5px;
        }
        
        .btn-view { background-color: #e7f1ff; color: #0d6efd; border: none; }
        .btn-view:hover { background-color: #0d6efd; color: white; }
        
        .btn-pdf { background-color: #ffeaea; color: #dc3545; border: none; }
        .btn-pdf:hover { background-color: #dc3545; color: white; }
        
        .btn-delete { background-color: #f8d7da; color: #dc3545; border: none; }
        .btn-delete:hover { background-color: #dc3545; color: white; }

        /* RESPONSIVIDAD */
        @media (max-width: 768px) {
            .navbar-brand span {
                font-size: 0.85rem; /* Texto más pequeño en navbar */
            }
            
            .navbar-brand img {
                height: 35px !important;
            }
            
            /* En móvil, ocultamos el nombre del admin para ahorrar espacio */
            .user-info-desktop {
                display: none !important;
            }
            
            h2 { font-size: 1.5rem; }
            
            /* La tabla tendrá scroll horizontal */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
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
                <div class="d-none d-md-block text-end lh-1 user-info-desktop">
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

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4 mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1" style="color: var(--pnp-green-dark);">Bandeja de Reclamaciones</h2>
                <p class="text-muted mb-0 small">Gestión y seguimiento de reclamos ciudadanos.</p>
            </div>

            <div class="col-md-4">
                <div class="card stat-card p-3 h-100 border-start border-4 border-warning">
                    <i class="bi bi-exclamation-circle icon-bg text-warning"></i>
                    <div class="d-flex flex-column">
                        <span class="stat-label mb-2">Reclamos Pendientes</span>
                        <div class="stat-value text-warning">
                            {{ $reclamos->where('estado', 'pendiente')->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card table-card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 100px;">Fecha</th>
                                <th style="width: 140px;">Código</th>
                                <th>Ciudadano</th>
                                <th>Documento</th>
                                <th style="width: 110px;">Estado</th>
                                <th class="text-end pe-4" style="width: 140px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reclamos as $reclamo)
                                <tr>
                                    <td>
                                        <div class="text-muted small fw-medium">
                                            <i class="bi bi-calendar3 me-1"></i> {{ $reclamo->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-bold font-monospace small">
                                            {{ $reclamo->codigo_seguimiento }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark text-truncate" style="max-width: 200px;">
                                            {{ $reclamo->nombre_completo }}
                                        </div>
                                    </td>
                                    <td>{{ $reclamo->numero_documento }}</td>
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
                                        <div class="d-flex justify-content-end">
                                            
                                            @if($reclamo->evidencia)
                                                <a href="{{ asset('storage/' . $reclamo->evidencia) }}" target="_blank" class="btn-action btn-pdf" title="Ver PDF">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </a>
                                            @endif

                                            <a href="{{ route('admin.show', $reclamo->id) }}" class="btn-action btn-view" title="Ver">
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
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                                        No hay reclamos registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>