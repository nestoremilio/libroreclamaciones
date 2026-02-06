<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle Reclamo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-3">&larr; Volver al Panel</a>

        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detalle del Reclamo: {{ $reclamo->codigo_seguimiento }}</h5>
                <span>{{ $reclamo->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted">Datos del Ciudadano</h6>
                        <p class="mb-0"><strong>Nombre:</strong> {{ $reclamo->nombre_completo }}</p>
                        <p class="mb-0"><strong>Documento:</strong> {{ $reclamo->tipo_documento }} -
                            {{ $reclamo->numero_documento }}</p>
                        <p class="mb-0"><strong>Teléfono:</strong> {{ $reclamo->telefono }}</p>
                        <p class="mb-0"><strong>Email:</strong> {{ $reclamo->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Sobre el Incidente</h6>
                        <p class="mb-0"><strong>Tipo:</strong> <span
                                class="text-uppercase">{{ $reclamo->tipo_reclamo }}</span></p>
                        <p class="mb-0"><strong>Bien Contratado:</strong> {{ $reclamo->tipo_bien }}</p>
                        <p class="mb-0"><strong>Descripción:</strong> {{ $reclamo->descripcion_bien }}</p>
                    </div>
                </div>

                <hr>

                <div class="mb-4">
                    <h6 class="text-danger">Detalle del Reclamo/Queja:</h6>
                    <div class="p-3 bg-light border rounded">
                        {{ $reclamo->detalle }}
                    </div>
                </div>

                <div class="mb-4">
                    <h6 class="text-primary">Pedido del Ciudadano:</h6>
                    <div class="p-3 bg-light border rounded">
                        {{ $reclamo->pedido }}
                    </div>
                </div>

                <hr>

                @if($reclamo->estado == 'pendiente')
                    <div class="text-end">
                        <form action="{{ route('admin.atender', $reclamo->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg"
                                onclick="return confirm('¿Está seguro de marcar este reclamo como atendido?')">
                                ✅ Marcar como Atendido
                            </button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-success text-center">
                        <strong>Este reclamo ya fue atendido.</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>