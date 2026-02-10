<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones - PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

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

        /* --- Header Institucional --- */
        .header-pnp {
            background: linear-gradient(135deg, var(--pnp-green) 0%, var(--pnp-green-dark) 100%);
            color: white;
            padding: 30px 0 80px;
            /* Ajusté un poco el padding superior */
            box-shadow: 0 4px 20px rgba(19, 88, 53, 0.3);
            text-align: center;
        }

        /* --- Tarjeta del Formulario --- */
        .form-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
            margin-top: -60px;
            border: none;
            overflow: hidden;
            position: relative;
        }

        .section-title {
            color: var(--pnp-green);
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            font-size: 1.1rem;
        }

        /* --- Inputs y Labels --- */
        .form-floating>label {
            padding-left: 2.5rem;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: var(--pnp-green);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--pnp-green);
            box-shadow: 0 0 0 0.25rem rgba(19, 88, 53, 0.25);
        }

        .form-control,
        .form-select {
            border-left: none;
        }

        /* --- Botón Principal --- */
        .btn-pnp {
            background-color: var(--pnp-green);
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s;
            border: none;
            width: 100%;
        }

        .btn-pnp:hover {
            background-color: var(--pnp-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(19, 88, 53, 0.4);
            color: white;
        }

        /* --- Radio Button Cards --- */
        .tipo-reclamo-card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .tipo-reclamo-card:hover {
            background-color: #f8f9fa;
            border-color: var(--pnp-green);
        }

        .form-check-input:checked {
            background-color: var(--pnp-green);
            border-color: var(--pnp-green);
        }

        /* --- Footer --- */
        .footer-text {
            font-size: 0.85rem;
            color: var(--pnp-gray);
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
        }

        .admin-link {
            color: var(--pnp-gray);
            text-decoration: none;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .admin-link:hover {
            color: var(--pnp-green);
        }

        /* --- Mobile --- */
        @media (max-width: 768px) {
            .header-pnp {
                padding: 30px 0 50px;
            }

            .form-card {
                margin-top: -30px;
                padding: 1.5rem !important;
            }
        }
    </style>
</head>

<body>

    <div class="header-pnp">
        <div class="container">
            <img src="{{ asset('images/direddoc.png') }}" alt="Logo DIREDDOC PNP" class="mb-3"
                style="height: 120px; width: auto; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));">

            <h1 class="fw-bold h2">Libro de Reclamaciones Virtual</h1>
            <p class="mb-0 opacity-75">Policía Nacional del Perú - 2026</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="form-card p-4 p-md-5 shadow-sm rounded-3">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('guardar-reclamo') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <h5 class="section-title">
                                <i class="bi bi-person-lines-fill"></i>
                                <span>1. Identificación del Usuario</span>
                            </h5>

                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="nombre" class="form-label text-muted small fw-bold">Nombre
                                        Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="nombre_completo" class="form-control" id="nombre"
                                            placeholder="Ingrese su nombre completo" required>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5">
                                    <label for="tipoDoc" class="form-label text-muted small fw-bold">Tipo
                                        Documento</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                        <select name="tipo_documento" class="form-select" id="tipoDoc">
                                            <option>DNI</option>
                                            <option>Carnet Extranjería</option>
                                            <option>Pasaporte</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-7">
                                    <label for="numDoc" class="form-label text-muted small fw-bold">Número
                                        Documento</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-123"></i></span>
                                        <input type="tel" name="numero_documento" class="form-control" id="numDoc"
                                            placeholder="Ej: 12345678" required inputmode="numeric">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="domicilio" class="form-label text-muted small fw-bold">Domicilio
                                        Actual</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" name="domicilio" class="form-control" id="domicilio"
                                            placeholder="Dirección completa" required>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="telefono" class="form-label text-muted small fw-bold">Teléfono /
                                        Celular</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                                        <input type="tel" name="telefono" class="form-control" id="telefono"
                                            placeholder="Ej: 999888777" required inputmode="tel">
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="email" class="form-label text-muted small fw-bold">Correo
                                        Electrónico</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="ejemplo@correo.com" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="section-title">
                                <i class="bi bi-file-earmark-text-fill"></i>
                                <span>2. Detalle de la Reclamación</span>
                            </h5>

                            <div class="row g-3">
                                <div class="col-12 col-md-8">
                                    <label for="tipoBien" class="form-label text-muted small fw-bold">Bien
                                        Contratado</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                                        <select name="tipo_bien" class="form-select" id="tipoBien">
                                            <option value="servicio">Servicio (Atención, trámites, etc.)</option>
                                            <option value="producto">Producto (Bienes materiales)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="monto" class="form-label text-muted small fw-bold">Monto
                                        (Opcional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">S/</span>
                                        <input type="number" step="0.01" name="monto_reclamado" class="form-control"
                                            id="monto" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="descBien" class="form-label text-muted small fw-bold">Descripción del
                                        Bien/Servicio</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                        <input type="text" name="descripcion_bien" class="form-control" id="descBien"
                                            placeholder="Ej: Trámite de Antecedentes Policiales" required>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <label class="fw-bold mb-3 d-block small text-uppercase text-secondary">Tipo de
                                        Registro:</label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="tipo-reclamo-card h-100">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_reclamo"
                                                        value="reclamo" id="radioReclamo" checked>
                                                    <label class="form-check-label fw-bold text-dark"
                                                        for="radioReclamo">
                                                        Reclamo
                                                    </label>
                                                    <small class="d-block text-muted lh-sm mt-1">Disconformidad
                                                        relacionada a los productos o servicios.</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="tipo-reclamo-card h-100">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_reclamo"
                                                        value="queja" id="radioQueja">
                                                    <label class="form-check-label fw-bold text-dark" for="radioQueja">
                                                        Queja
                                                    </label>
                                                    <small class="d-block text-muted lh-sm mt-1">Malestar o descontento
                                                        respecto a la atención al público.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="detalle" class="form-label text-muted small fw-bold">Detalle de los
                                        hechos</label>
                                    <textarea name="detalle" class="form-control"
                                        placeholder="Describa detalladamente lo sucedido..." id="detalle"
                                        style="height: 120px" required></textarea>
                                </div>

                                <div class="col-12">
                                    <label for="pedido" class="form-label text-muted small fw-bold">Pedido del
                                        Usuario</label>
                                    <textarea name="pedido" class="form-control"
                                        placeholder="¿Qué solución espera recibir?" id="pedido" style="height: 100px"
                                        required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-pnp btn-lg shadow">
                                <i class="bi bi-send-fill me-2"></i> Enviar Reclamo
                            </button>
                            <p class="small text-muted mt-3">
                                <i class="bi bi-lock-fill"></i> Sus datos serán tratados conforme a la Ley de Protección
                                de Datos Personales.
                            </p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-text">
        <div class="container">
            <hr class="mb-4 opacity-25">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span class="mb-2 mb-md-0">&copy; 2026 Policía Nacional del Perú - DIREDDOC</span>
                <a href="{{ route('login') }}" class="admin-link">
                    <i class="bi bi-shield-lock me-1"></i> Acceso Administrativo
                </a>
            </div>
        </div>
    </footer>

</body>

</html>