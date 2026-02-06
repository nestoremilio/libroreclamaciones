<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de Reclamaciones - PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .header-pnp {
            background-color: #0c4b33;
            color: white;
            padding: 20px 0;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: -30px;
        }
    </style>
</head>

<body>

    <div class="header-pnp text-center">
        <h1>Libro de Reclamaciones Virtual</h1>
        <p class="mb-0">Policía Nacional del Perú - UTIC</p>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <h4 class="mb-4 text-center">Hoja de Reclamación</h4>

                    <form action="{{ route('guardar-reclamo') }}" method="POST">
                        @csrf

                        <h5 class="text-success border-bottom pb-2">1. Identificación del Usuario</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Nombre Completo:</label>
                                <input type="text" name="nombre_completo" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tipo Doc:</label>
                                <select name="tipo_documento" class="form-select">
                                    <option>DNI</option>
                                    <option>Carnet Extranjería</option>
                                    <option>Pasaporte</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Número Documento:</label>
                                <input type="text" name="numero_documento" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Domicilio:</label>
                                <input type="text" name="domicilio" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Teléfono:</label>
                                <input type="text" name="telefono" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <h5 class="text-success border-bottom pb-2 mt-4">2. Detalle de la Reclamación</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tipo de Bien:</label>
                                <select name="tipo_bien" class="form-select">
                                    <option value="servicio">Servicio</option>
                                    <option value="producto">Producto</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Monto Reclamado (Opcional):</label>
                                <input type="number" step="0.01" name="monto_reclamado" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Descripción del Bien/Servicio:</label>
                                <input type="text" name="descripcion_bien" class="form-control"
                                    placeholder="Ej: Trámite de antecedentes, Atención en ventanilla..." required>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label class="form-label fw-bold">Tipo:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo_reclamo" value="reclamo"
                                        checked>
                                    <label class="form-check-label">Reclamo (Disconformidad con el servicio)</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo_reclamo" value="queja">
                                    <label class="form-check-label">Queja (Malestar por atención al público)</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Detalle del Reclamo/Queja:</label>
                                <textarea name="detalle" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Pedido del Usuario:</label>
                                <textarea name="pedido" class="form-control" rows="2" required></textarea>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-5">Enviar Reclamo</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>