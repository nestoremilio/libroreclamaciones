<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones - Policía Nacional del Perú</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            /* Palette - Fresh & Friendly Institutional */
            --pnp-green-main: #007A5E; /* Vibrant Institutional Green */
            --pnp-green-dark: #004d3a;
            --pnp-green-light: #e6f4f1;
            
            --accent-yellow: #f9d56e;
            --accent-blue-light: #dceeef;
            
            --text-dark: #2c3e50;
            --text-muted: #7f8c8d;
            
            --bg-body: #f7fcfb;
            
            --card-radius: 24px;
            --btn-radius: 50px;
            --input-radius: 12px;
            
            --shadow-soft: 0 10px 40px -10px rgba(0, 87, 65, 0.1);
            --shadow-hover: 0 15px 45px -5px rgba(0, 87, 65, 0.15);
        }

        body {
            background-color: var(--bg-body);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(220, 238, 239, 1) 0%, rgba(247, 252, 251, 0) 50%),
                radial-gradient(circle at 90% 80%, rgba(249, 213, 110, 0.15) 0%, rgba(247, 252, 251, 0) 50%);
            font-family: 'Outfit', sans-serif;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* --- Header / Decorative Top --- */
        .decorative-header {
            background: linear-gradient(135deg, var(--pnp-green-main) 0%, var(--pnp-green-dark) 100%);
            height: 280px;
            position: relative;
            border-bottom-right-radius: 60px;
            border-bottom-left-radius: 60px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0, 122, 94, 0.2);
            color: white;
            padding-top: 40px;
            text-align: center;
        }
        
        /* Abstract waves via CSS */
        .decorative-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100%25' height='100%25' viewBox='0 0 1600 800' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%23ffffff' stroke-width='1' stroke-opacity='0.1'%3E%3Ccircle cx='0' cy='0' r='1800'/%3E%3Ccircle cx='0' cy='0' r='1700'/%3E%3Ccircle cx='0' cy='0' r='1600'/%3E%3Ccircle cx='0' cy='0' r='1500'/%3E%3Ccircle cx='0' cy='0' r='1400'/%3E%3Ccircle cx='0' cy='0' r='1300'/%3E%3Ccircle cx='0' cy='0' r='1200'/%3E%3Ccircle cx='0' cy='0' r='1100'/%3E%3Ccircle cx='0' cy='0' r='1000'/%3E%3Ccircle cx='0' cy='0' r='900'/%3E%3Ccircle cx='0' cy='0' r='800'/%3E%3Ccircle cx='0' cy='0' r='700'/%3E%3Ccircle cx='0' cy='0' r='600'/%3E%3Ccircle cx='0' cy='0' r='500'/%3E%3Ccircle cx='0' cy='0' r='400'/%3E%3Ccircle cx='0' cy='0' r='300'/%3E%3Ccircle cx='0' cy='0' r='200'/%3E%3Ccircle cx='0' cy='0' r='100'/%3E%3C/g%3E%3C/svg%3E");
            background-size: cover;
            opacity: 0.3;
        }

        .brand-logo {
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }
        .brand-logo:hover {
            transform: scale(1.05);
        }

        /* --- Main Layout --- */
        .main-container {
            margin-top: -100px;
            padding-bottom: 60px;
            position: relative;
            z-index: 10;
        }

        .illustration-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--pnp-green-dark);
            text-align: center;
            padding: 20px;
        }
        
        .illustration-placeholder {
            font-size: 8rem;
            color: var(--pnp-green-main);
            background: white;
            border-radius: 50%;
            width: 180px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-soft);
            margin-bottom: 20px;
        }

        /* --- Form Card --- */
        .form-card {
            background: white;
            border-radius: var(--card-radius);
            box-shadow: var(--shadow-soft);
            border: none;
            padding: 2.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .section-header {
            margin-bottom: 30px;
            position: relative;
            padding-left: 20px;
        }
        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 5px;
            bottom: 5px;
            width: 4px;
            background: var(--pnp-green-main);
            border-radius: 4px;
        }
        
        .section-title {
            font-weight: 700;
            color: var(--pnp-green-dark);
            margin: 0;
            font-size: 1.25rem;
        }
        .section-subtitle {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0;
        }

        /* --- Inputs & Groups --- */
        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }
        
        .input-group-text {
            background-color: var(--pnp-green-light);
            border: 1px solid transparent;
            color: var(--pnp-green-main);
            border-top-left-radius: var(--input-radius);
            border-bottom-left-radius: var(--input-radius);
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .form-control, .form-select {
            border: 1px solid #e1e8ed;
            padding: 0.75rem 1rem;
            border-radius: var(--input-radius);
            font-size: 0.95rem;
            transition: all 0.2s;
            background-color: #fcfdfe;
        }
        
        .input-group .form-control, .input-group .form-select {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: none;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--pnp-green-main);
            box-shadow: 0 0 0 4px rgba(0, 122, 94, 0.1);
            background-color: white;
        }

        /* --- Radio Cards --- */
        .radio-card-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .radio-card-input {
            display: none;
        }
        
        .radio-card-label {
            display: block;
            border: 2px solid #e1e8ed;
            border-radius: var(--input-radius);
            padding: 1.25rem;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            height: 100%;
            background: white;
        }
        
        .radio-card-input:checked + .radio-card-label {
            border-color: var(--pnp-green-main);
            background-color: var(--pnp-green-light);
        }
        
        .radio-card-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--text-dark);
            display: block;
            margin-bottom: 4px;
        }
        .radio-card-input:checked + .radio-card-label .radio-card-title {
            color: var(--pnp-green-main);
        }
        
        .radio-card-text {
            color: var(--text-muted);
            font-size: 0.85rem;
            line-height: 1.4;
            display: block;
        }

        /* --- Buttons --- */
        .btn-pnp-primary {
            background-color: var(--pnp-green-main);
            background-image: linear-gradient(135deg, var(--pnp-green-main) 0%, #00684f 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: var(--btn-radius);
            box-shadow: 0 6px 15px rgba(0, 122, 94, 0.25);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            letter-spacing: 0.5px;
        }
        
        .btn-pnp-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 122, 94, 0.35);
            color: white;
        }
        
        .btn-pnp-primary:active {
            transform: translateY(1px);
        }

        .btn-check-status {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.15);
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 0.9rem;
            transition: background 0.2s;
            backdrop-filter: blur(5px);
        }
        .btn-check-status:hover {
            background: rgba(255,255,255,0.25);
            color: white;
        }

        /* --- Footer --- */
        .simple-footer {
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            padding: 20px;
            margin-top: auto;
        }
        
        .simple-footer a {
            color: var(--pnp-green-main);
            text-decoration: none;
            font-weight: 500;
        }

        @media (max-width: 991px) {
            .decorative-header {
                height: 240px;
                border-radius: 0 0 40px 40px;
            }
            .form-card {
                padding: 1.5rem;
                margin-top: -60px;
            }
            .illustration-col {
                display: none; /* Hide illustration on mobile to save space */
            }
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header class="decorative-header">
        <div class="container h-100 d-flex flex-column align-items-center">
            
            <div class="d-flex justify-content-between w-100 px-3 align-items-start" style="max-width: 1200px;">
                <div class="d-flex align-items-center gap-3">
                     <!-- Replace with asset() when deploying, using direct URL for preview if needed -->
                    <img src="{{ asset('images/direddoc.png') }}" alt="Logo DIREDDOC" class="brand-logo" 
                         style="height: 60px; width: auto; background: white; padding: 5px; border-radius: 12px;">
                    <div class="text-start d-none d-sm-block">
                        <div class="fw-bold small opacity-75 text-uppercase letter-spacing-1">Policía Nacional del Perú</div>
                        <div class="fw-bold h5 mb-0">Educación y Doctrina</div>
                    </div>
                </div>
                
                <a href="{{ route('login') }}" class="btn-check-status">
                    <i class="bi bi-shield-lock-fill me-1"></i> Admin
                </a>
            </div>

            <div class="mt-4 text-center">
                <h1 class="fw-bold display-6 mb-2">Libro de Reclamaciones Virtual</h1>
                <p class="lead fs-6 opacity-90 mx-auto" style="max-width: 600px;">
                    Estamos comprometidos a escucharte. Tu opinión nos ayuda a mejorar nuestros servicios educativos y administrativos.
                </p>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container main-container">
        <div class="row g-4 justify-content-center">
            
            <!-- Friendly Illustration Side (Desktop) -->
            <div class="col-lg-4 d-none d-lg-flex illustration-col">
                <div class="sticky-top" style="top: 100px;">
                    <div class="illustration-placeholder">
                        <i class="bi bi-person-heart display-1 text-success"></i>
                    </div>
                    <h3 class="fw-bold h4 mb-3">Estamos para ayudarte</h3>
                    <p class="text-muted small px-4">
                        Complete el formulario con sus datos reales para poder atender su y solicitud a la brevedad posible.
                    </p>
                    
                    <div class="card border-0 bg-white shadow-sm rounded-4 mt-4 p-3 w-100 text-start">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="bg-light rounded-circle p-2 text-primary">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <small class="d-block text-muted" style="font-size: 11px;">Escríbanos a</small>
                                <span class="fw-bold small text-dark">contacto@direddoc.pnp.gob.pe</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-light rounded-circle p-2 text-warning">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <small class="d-block text-muted" style="font-size: 11px;">Llámenos al</small>
                                <span class="fw-bold small text-dark">(01) 460-1234</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Side -->
            <div class="col-lg-8 col-xl-7">
                <div class="form-card">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                                <div>
                                    <h6 class="fw-bold mb-1">¡Registro Exitoso!</h6>
                                    <div class="small">{{ session('success') }}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('guardar-reclamo') }}" method="POST">
                        @csrf

                        <!-- Section 1 -->
                        <div class="section-header">
                            <h5 class="section-title">Identificación del Usuario</h5>
                            <p class="section-subtitle">Sus datos personales para contactarlo</p>
                        </div>

                        <div class="row g-3 mb-5">
                            <div class="col-12">
                                <label for="nombre" class="form-label">Nombre Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                    <input type="text" name="nombre_completo" class="form-control" id="nombre" 
                                           placeholder="Ej: Juan Pérez" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="tipoDoc" class="form-label">Tipo Documento</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                    <select name="tipo_documento" class="form-select" id="tipoDoc">
                                        <option>DNI</option>
                                        <option>Carnet Extranjería</option>
                                        <option>Pasaporte</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <label for="numDoc" class="form-label">Número Documento</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-123"></i></span>
                                    <input type="tel" name="numero_documento" class="form-control" id="numDoc" 
                                           placeholder="Ej: 12345678" required inputmode="numeric">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="domicilio" class="form-label">Domicilio Actual</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                                    <input type="text" name="domicilio" class="form-control" id="domicilio" 
                                           placeholder="Dirección completa" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono / Celular</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-phone-fill"></i></span>
                                    <input type="tel" name="telefono" class="form-control" id="telefono" 
                                           placeholder="999 888 777" required inputmode="tel">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                    <input type="email" name="email" class="form-control" id="email" 
                                           placeholder="nombre@correo.com" required>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2 -->
                        <div class="section-header">
                            <h5 class="section-title">Detalle de la Reclamación</h5>
                            <p class="section-subtitle">Información sobre el bien o servicio</p>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="tipoBien" class="form-label">Bien Contratado</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-box-seam-fill"></i></span>
                                    <select name="tipo_bien" class="form-select" id="tipoBien">
                                        <option value="servicio">Servicio (Atención, trámites, etc.)</option>
                                        <option value="producto">Producto (Bienes materiales)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="monto" class="form-label">Monto (Opcional)</label>
                                <div class="input-group">
                                    <span class="input-group-text">S/</span>
                                    <input type="number" step="0.01" name="monto_reclamado" class="form-control" 
                                           id="monto" placeholder="0.00">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="descBien" class="form-label">Descripción del Bien/Servicio</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-chat-text-fill"></i></span>
                                    <input type="text" name="descripcion_bien" class="form-control" id="descBien" 
                                           placeholder="Ej: Solicitud de certificado..." required>
                                </div>
                            </div>

                            <!-- Radio Cards -->
                            <div class="col-12 mt-4">
                                <label class="form-label mb-3">Tipo de Registro</label>
                                <div class="radio-card-group">
                                    <div>
                                        <input type="radio" name="tipo_reclamo" value="reclamo" id="radioReclamo" class="radio-card-input" checked>
                                        <label for="radioReclamo" class="radio-card-label">
                                            <span class="radio-card-title"><i class="bi bi-exclamation-circle-fill me-2"></i>Reclamo</span>
                                            <span class="radio-card-text">Disconformidad relacionada a los productos o servicios ofrecidos.</span>
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="tipo_reclamo" value="queja" id="radioQueja" class="radio-card-input">
                                        <label for="radioQueja" class="radio-card-label">
                                            <span class="radio-card-title"><i class="bi bi-emoji-frown-fill me-2"></i>Queja</span>
                                            <span class="radio-card-text">Malestar o descontento respecto a la atención recibida.</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <label for="detalle" class="form-label">Detalle de los hechos</label>
                                <textarea name="detalle" class="form-control" id="detalle" 
                                          style="height: 120px" placeholder="Por favor, explique detalladamente lo sucedido aquí..." required></textarea>
                            </div>

                            <div class="col-12">
                                <label for="pedido" class="form-label">Pedido del Usuario</label>
                                <textarea name="pedido" class="form-control" id="pedido" 
                                          style="height: 100px" placeholder="¿Qué solución espera recibir por parte de la institución?" required></textarea>
                            </div>
                        </div>

                        <div class="text-center mt-5 mb-3">
                            <button type="submit" class="btn btn-pnp-primary">
                                Registrar Reclamación
                            </button>
                            <div class="mt-3">
                                <small class="text-muted"><i class="bi bi-lock-fill"></i> Sus datos están protegidos por la Ley N° 29733</small>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="simple-footer">
        <div class="container">
            <p class="mb-1">&copy; 2026 Dirección de Educación y Doctrina - Policía Nacional del Perú</p>
            <p class="mb-0 opacity-75">Desarrollado por la Unidad de Tecnologías de la Información y Comunicaciones (UNITIC)</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>