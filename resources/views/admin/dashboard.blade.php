<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - PNP</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --pnp-green: #135835;
<<<<<<< HEAD
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }

        /* --- Cards & Widgets --- */
=======
            /* Verde Institucional PNP */
            --pnp-dark: #0b3d24;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
        }

        /* Navbar Verde PNP */
        .bg-pnp {
            background-color: var(--pnp-green) !important;
        }

        /* Tarjeta con borde superior verde */
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
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
        
        .stat-card .stat-label {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        /* --- Table --- */
        .table-card {
            overflow: hidden; 
        }

        /* Cabecera de tabla estilo PNP */
        .table thead th {
<<<<<<< HEAD
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            border-bottom: 2px solid #e9ecef;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.8rem;
=======
            background-color: var(--pnp-green);
            color: white;
            font-weight: 500;
            border: none;
            padding: 15px;
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
            letter-spacing: 0.5px;
        }

        .table tbody td {
            vertical-align: middle;
<<<<<<< HEAD
            padding: 1rem;
            color: #212529;
            font-size: 0.95rem;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(19, 88, 53, 0.03);
        }

        /* --- Badges --- */
=======
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        /* Botón personalizado PNP */
        .btn-pnp {
            background-color: var(--pnp-green);
            border-color: var(--pnp-green);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-pnp:hover {
            background-color: var(--pnp-dark);
            color: white;
            transform: translateY(-1px);
        }

        /* Etiquetas de estado */
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
        .badge-status {
            padding: 8px 12px;
            border-radius: 30px;
            font-weight: 600;
<<<<<<< HEAD
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
=======
            font-size: 0.85rem;
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
        }

        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .status-atendido {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        /* --- Buttons --- */
        .btn-action {
            width: 32px;
            height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s;
        }

        .btn-view {
            background-color: #e7f1ff;
            color: #0d6efd;
            border: none;
        }
        .btn-view:hover { background-color: #0d6efd; color: white; }

        .btn-delete {
            background-color: #f8d7da;
            color: #dc3545;
            border: none;
        }
        .btn-delete:hover { background-color: #dc3545; color: white; }

    </style>
</head>

<body>
<<<<<<< HEAD
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-pnp py-3 sticky-top">
=======
    <nav class="navbar navbar-expand-lg navbar-dark bg-pnp py-3 shadow-sm">
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <i class="bi bi-shield-lock-fill fs-4"></i> 
                <span>PANEL DE CONTROL PNP</span>
            </a>
<<<<<<< HEAD
            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-block text-end lh-1">
                    <div class="text-white fw-bold" style="font-size: 0.9rem;">Administrador</div>
                    <small class="text-white-50" style="font-size: 0.75rem;">Sesión Activa</small>
                </div>
                <div class="vr text-white opacity-25 mx-2"></div>
=======
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small opacity-90">
                    <i class="bi bi-person-circle me-1"></i> Administrador
                </span>
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm px-3 rounded-pill border-opacity-50">
                        <i class="bi bi-box-arrow-right me-1"></i> Salir
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container py-5 flex-grow-1">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

<<<<<<< HEAD
        <!-- Cabecera y Resumen -->
        <div class="row g-4 mb-4 align-items-center">
            <div class="col-md-8">
                <h2 class="fw-bold mb-1" style="color: var(--pnp-green-dark);">Bandeja de Reclamaciones</h2>
                <p class="text-muted mb-0">Gestión y seguimiento de reclamos ciudadanos.</p>
=======
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4 align-items-end">
            <div class="col-md-8">
                <h3 class="fw-bold" style="color: var(--pnp-green);">Bandeja de Reclamaciones</h3>
                <p class="text-muted">Gestione los reclamos ciudadanos registrados.</p>
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
            </div>
            
            <!-- Widget Pendientes -->
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

        <!-- Tabla -->
        <div class="card table-card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
<<<<<<< HEAD
                                <th style="width: 120px;">Fecha</th>
                                <th style="width: 150px;">Código</th>
                                <th>Ciudadano</th>
                                <th>Documento</th>
                                <th style="width: 120px;">Estado</th>
                                <th class="text-end pe-4" style="width: 120px;">Acciones</th>
=======
                                <td>
                                    <span class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i> {{ $reclamo->created_at->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $reclamo->codigo_seguimiento }}</span>
                                </td>
                                <td>{{ $reclamo->nombre_completo }}</td>
                                <td>{{ $reclamo->numero_documento }}</td>
                                <td>
                                    @if($reclamo->estado == 'pendiente')
                                        <span class="badge badge-status status-pendiente">
                                            <i class="bi bi-hourglass-split me-1"></i> Pendiente
                                        </span>
                                    @else
                                        <span class="badge badge-status status-atendido">
                                            <i class="bi bi-check-circle-fill me-1"></i> Atendido
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.show', $reclamo->id) }}"
                                        class="btn btn-pnp btn-sm rounded-pill px-3">
                                        Ver y Atender <i class="bi bi-arrow-right-short"></i>
                                    </a>

                                    <form action="{{ route('admin.destroy', $reclamo->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este reclamo de forma permanente?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 ms-1"
                                            title="Eliminar Reclamo">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c
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
                                        <span class="badge bg-light text-dark border fw-bold font-monospace">
                                            {{ $reclamo->codigo_seguimiento }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $reclamo->nombre_completo }}</div>
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
                                        <div class="d-flex justify-content-end gap-2">
                                            <!-- Botón Ver (Placeholder href) -->
                                            <a href="{{ route('admin.show', $reclamo->id) }}" class="btn-action btn-view" title="Ver Detalle">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>
                                            
                                            <!-- Botón Eliminar -->
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
<<<<<<< HEAD
=======

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
>>>>>>> 45fa20c0cd6b59da74cdf955984408902805c55c

</body>
</html>