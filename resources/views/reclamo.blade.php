<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones - PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- ESTILOS GENERALES --- */
        .header-pnp {
            background: linear-gradient(135deg, #0c4b33 0%, #157347 100%);
            color: white;
            padding: 40px 0 80px;
            box-shadow: 0 4px 20px rgba(12, 75, 51, 0.3);
            transition: padding 0.3s ease;
        }

        .form-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin-top: -60px;
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .section-title {
            color: #0c4b33;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            font-size: 1.1rem;
        }

        /* Botón de Envío */
        .btn-pnp {
            background-color: #0c4b33;
            color: white;
            font-weight: 600;
            padding: 12px 40px;
            border-radius: 50px;
            transition: all 0.3s;
            border: none;
        }

        .btn-pnp:hover {
            background-color: #093624;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(12, 75, 51, 0.4);
            color: white !important;
        }

        .form-floating>.form-control:focus {
            border-color: #157347;
            box-shadow: 0 0 0 0.25rem rgba(21, 115, 71, 0.25);
        }

        .footer-text {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Botón Admin */
        .admin-link {
            text-decoration: none;
            color: white;
            background-color: #0c4b33;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .admin-link:hover {
            background-color: #093624;
            transform: translateY(-3px);
            color: white;
        }

        /* --- OPTIMIZACIÓN MÓVIL (RESPONSIVE) --- */
        @media (max-width: 768px) {
            .header-pnp {
                padding: 30px 0 60px;
                /* Menos altura en header */
            }

            .header-pnp h1 {
                font-size: 1.5rem;
                /* Título más pequeño */
            }

            .display-4 {
                font-size: 2.5rem;
                /* Icono escudo más pequeño */
            }

            .form-card {
                margin-top: -40px;
                /* Menos margen negativo */
                border-radius: 12px;
                padding: 1.5rem !important;
                /* Menos padding interno */
            }

            .btn-pnp {
                width: 100%;
                /* Botón ancho completo para dedos */
                padding: 14px;
                font-size: 1.1rem;
            }

            /* Inputs más grandes para evitar zoom en iOS */
            .form-control,
            .form-select {
                font-size: 16px;
            }

            .section-title {
                font-size: 1rem;
                flex-direction: column;
                /* Icono arriba del texto en títulos largos */
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>

<body>

    <div class="header-pnp text-center">
        <div class="container px-4">
            <i class="bi bi-shield-check display-4 mb-2"></i>
            <h1 class="fw-bold">Libro de Reclamaciones Virtual</h1>
            <p class="mb-0 opacity-75 small">Policía Nacional del Perú - Unidad de Tecnología (UTIC)</p>
        </div>
    </div>

    <div class="container pb-5 flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <div class="form-card p-3 p-md-5">

                    <form action="{{ route('guardar-reclamo') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <h5 class="section-title">
                                <div><i class="bi bi-person-vcard-fill fs-4 me-2"></i></div>
                                <span>1. Identificación del Usuario</span>
                            </h5>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="nombre_completo" class="form-control" id="nombre"
                                            placeholder="Nombre" required>
                                        <label for="nombre">Nombre Completo</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-floating">
                                        <select name="tipo_documento" class="form-select" id="tipoDoc">
                                            <option>DNI</option>
                                            <option>Carnet Extranjería</option>
                                            <option>Pasaporte</option>
                                        </select>
                                        <label for="tipoDoc">Tipo Doc.</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-8">
                                    <div class="form-floating">
                                        <input type="tel" name="numero_documento" class="form-control" id="numDoc"
                                            placeholder="Número" required inputmode="numeric">
                                        <label for="numDoc">Número de Documento</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="domicilio" class="form-control" id="domicilio"
                                            placeholder="Dirección" required>
                                        <label for="domicilio">Domicilio Actual</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" name="telefono" class="form-control" id="telefono"
                                            placeholder="Teléfono" required inputmode="tel">
                                        <label for="telefono">Teléfono / Celular</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Email" required>
                                        <label for="email">Correo Electrónico</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="section-title">
                                <div><i class="bi bi-clipboard-data-fill fs-4 me-2"></i></div>
                                <span>2. Detalle de la Reclamación</span>
                            </h5>

                            <div class="row g-3">
                                <div class="col-12 col-md-8">
                                    <div class="form-floating">
                                        <select name="tipo_bien" class="form-select" id="tipoBien">
                                            <option value="servicio">Servicio (Atención, trámites, etc.)</option>
                                            <option value="producto">Producto (Bienes materiales)</option>
                                        </select>
                                        <label for="tipoBien">Bien Contratado</label>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="form-floating">
                                        <input type="number" step="0.01" name="monto_reclamado" class="form-control"
                                            id="monto" placeholder="Monto" inputmode="decimal">
                                        <label for="monto">Monto (Opcional)</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="descripcion_bien" class="form-control" id="descBien"
                                            placeholder="Descripción" required>
                                        <label for="descBien">Descripción (Ej: Trámite de Antecedentes)</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <label class="fw-bold mb-2 d-block small text-uppercase text-muted">Seleccione el
                                        Tipo:</label>
                                    <div class="d-flex flex-column flex-md-row gap-3 p-3 border rounded bg-light">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_reclamo"
                                                value="reclamo" id="radioReclamo" checked>
                                            <label class="form-check-label fw-bold text-dark" for="radioReclamo">
                                                Reclamo
                                            </label>
                                            <small class="d-block text-muted lh-1 mt-1">Disconformidad con productos o
                                                servicios.</small>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_reclamo"
                                                value="queja" id="radioQueja">
                                            <label class="form-check-label fw-bold text-dark" for="radioQueja">
                                                Queja
                                            </label>
                                            <small class="d-block text-muted lh-1 mt-1">Malestar por la atención al
                                                público.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="detalle" class="form-control" placeholder="Detalle" id="detalle"
                                            style="height: 120px" required></textarea>
                                        <label for="detalle">Detalle de los hechos</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="pedido" class="form-control" placeholder="Pedido" id="pedido"
                                            style="height: 100px" required></textarea>
                                        <label for="pedido">Pedido del Usuario</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-pnp btn-lg">
                                <i class="bi bi-send-fill me-2"></i> Registrar Reclamo
                            </button>
                            <p class="footer-text mt-3 px-3">Sus datos serán tratados conforme a la Ley de Protección de
                                Datos Personales.</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 mt-auto">
        <div class="container">
            <hr class="mb-4 text-muted opacity-25">
            <a href="{{ route('login') }}" class="admin-link">
                <i class="bi bi-shield-lock me-1"></i> Acceso Administrativo
            </a>
            <p class="small text-muted mt-2 opacity-50">&copy; {{ date('Y') }} DESARROLLADO POR UNITIC-DIREDDOC PNP</p>
        </div>
    </footer>

</body>

</html>