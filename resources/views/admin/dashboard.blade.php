<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel Admin - PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-dark bg-success mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Panel de Control - Libro de Reclamaciones</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Cerrar Sesión</button>
            </form>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header bg-white">
                <h5 class="mb-0">Lista de Reclamaciones</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Ciudadano</th>
                            <th>DNI</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reclamos as $reclamo)
                            <tr>
                                <td>{{ $reclamo->created_at->format('d/m/Y') }}</td>
                                <td><span class="badge bg-secondary">{{ $reclamo->codigo_seguimiento }}</span></td>
                                <td>{{ $reclamo->nombre_completo }}</td>
                                <td>{{ $reclamo->numero_documento }}</td>
                                <td>
                                    @if($reclamo->estado == 'pendiente')
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @else
                                        <span class="badge bg-success">Atendido</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.show', $reclamo->id) }}" class="btn btn-sm btn-primary">Ver
                                        Detalle</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>