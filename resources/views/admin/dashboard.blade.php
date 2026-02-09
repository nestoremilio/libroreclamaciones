<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Admin - PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
            border: none;
            padding: 15px;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 15px;
        }

        .badge-status {
            padding: 8px 12px;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-atendido {
            background-color: #d1e7dd;
            color: #0f5132;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-shield-lock-fill me-2"></i> Panel de Control PNP
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3 small opacity-75">
                    <i class="bi bi-person-circle me-1"></i> Administrador
                </span>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm px-3 rounded-pill">Cerrar Sesión</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-8">
                <h3 class="fw-bold text-dark">Bandeja de Reclamaciones</h3>
                <p class="text-muted">Gestione los reclamos ciudadanos registrados.</p>
            </div>
            <div class="col-md-4 text-end">
                <div class="p-3 bg-white rounded shadow-sm border d-inline-block">
                    <small class="text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Pendientes</small>
                    <div class="fs-4 fw-bold text-warning">
                        {{ $reclamos->where('estado', 'pendiente')->count() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Cód. Seguimiento</th>
                            <th>Ciudadano</th>
                            <th>DNI/Doc</th>
                            <th>Estado Actual</th>
                            <th class="text-end">Gestión</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reclamos as $reclamo)
                            <tr>
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
                                        class="btn btn-primary btn-sm rounded-pill px-3">
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>