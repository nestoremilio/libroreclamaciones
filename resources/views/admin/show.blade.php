<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle Reclamo - DIREDDOC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <div class="container mt-4 mb-5" style="max-width: 860px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al Panel
            </a>
            <a href="{{ route('admin.reporte', $reclamo->id) }}" class="btn btn-success">
                <i class="bi bi-download me-2"></i> Descargar Reporte PDF
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header text-white d-flex justify-content-between align-items-center" style="background:#135835;">
                <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>N° {{ $reclamo->numero_hoja_reclamacion ?: 'Sin número' }}</h5>
                <span class="small">{{ $reclamo->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="card-body p-4">

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted text-uppercase fw-bold small mb-3">Datos del Ciudadano</h6>
                        <p class="mb-1"><strong>Nombre:</strong> {{ $reclamo->nombres_apellidos }}</p>
                        <p class="mb-1"><strong>Documento:</strong> {{ $reclamo->tipo_documento }} - {{ $reclamo->numero_documento }}</p>
                        <p class="mb-1"><strong>Domicilio:</strong> {{ $reclamo->domicilio }}</p>
                        <p class="mb-1"><strong>Teléfono:</strong> {{ $reclamo->telefono ?: '—' }}</p>
                        <p class="mb-1"><strong>Correo:</strong> {{ $reclamo->correo }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted text-uppercase fw-bold small mb-3">Sobre el Reclamo</h6>
                        <p class="mb-1"><strong>Tipo:</strong>
                            <span class="badge {{ $reclamo->tipo_registro == 'reclamo' ? 'bg-warning text-dark' : 'bg-secondary' }}">
                                {{ ucfirst($reclamo->tipo_registro) }}
                            </span>
                        </p>
                        <p class="mb-1"><strong>Dependencia/Servicio:</strong> {{ $reclamo->dependencia }}</p>
                        <p class="mb-1"><strong>Estado:</strong>
                            @if($reclamo->estado == 'pendiente')
                                <span class="badge" style="background:#fff3cd;color:#856404;">Pendiente</span>
                            @elseif($reclamo->estado == 'en_proceso')
                                <span class="badge bg-primary">En Proceso</span>
                            @else
                                <span class="badge bg-success">Resuelto</span>
                            @endif
                        </p>
                        <p class="mb-1">
                            <strong>Evidencia:</strong>
                            @if($reclamo->evidencia_pdf_path)
                                <span class="badge bg-success ms-1"><i class="bi bi-paperclip me-1"></i>Adjunta (incluida en el reporte)</span>
                            @else
                                <span class="text-muted small">Sin evidencia adjunta</span>
                            @endif
                        </p>
                    </div>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="text-danger fw-bold">Detalle de los Hechos:</h6>
                    <div class="p-3 bg-light border rounded">{{ $reclamo->detalle_hechos }}</div>
                </div>

                <div class="mb-4">
                    <h6 class="text-primary fw-bold">Pedido del Ciudadano:</h6>
                    <div class="p-3 bg-light border rounded">{{ $reclamo->pedido_usuario }}</div>
                </div>

                <hr>

                @if($reclamo->estado == 'pendiente')
                    <div class="text-end">
                        <form action="{{ route('admin.atender', $reclamo->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg"
                                onclick="return confirm('¿Está seguro de marcar este reclamo como En Proceso?')">
                                <i class="bi bi-gear-fill me-2"></i> Marcar como En Proceso
                            </button>
                        </form>
                    </div>
                @elseif($reclamo->estado == 'en_proceso')
                    <div class="alert alert-primary text-center mb-0">
                        <i class="bi bi-gear-fill me-2"></i> <strong>Este reclamo está siendo atendido.</strong>
                    </div>
                @else
                    <div class="alert alert-success text-center mb-0">
                        <i class="bi bi-check-circle-fill me-2"></i> <strong>Este reclamo ya fue resuelto.</strong>
                    </div>
                @endif

            </div>
        </div>
    </div>
</body>

</html>
