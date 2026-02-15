<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones - DIREDDOC PNP</title>
    <link rel="icon" href="{{ asset('images/direddoc.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    @livewireStyles

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
            padding: 40px 0 90px;
            box-shadow: 0 4px 20px rgba(19, 88, 53, 0.3);
            text-align: center;
        }

        .header-logo {
            height: 120px;
            width: auto;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
            transition: all 0.3s ease;
        }

        /* --- Tarjeta del Formulario --- */
        .form-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15);
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

        /* --- Inputs y Labels (Estilos globales para Livewire) --- */
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            color: var(--pnp-green);
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--pnp-green);
            box-shadow: 0 0 0 0.25rem rgba(19, 88, 53, 0.25);
        }

        .form-control, .form-select {
            border: 1px solid #ced4da;
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

        /* --- RESPONSIVIDAD (MOBILE) --- */
        @media (max-width: 768px) {
            .header-pnp { padding: 30px 15px 70px; }
            .header-logo { height: 80px; }
            .h2 { font-size: 1.5rem; }
            .form-card { margin-top: -40px; padding: 1.5rem !important; border-radius: 0.8rem; }
        }
    </style>
</head>

<body>

    <div class="header-pnp">
        <div class="container">
            <img src="{{ asset('images/direddoc.png') }}" alt="Logo DIREDDOC PNP" class="header-logo mb-3">
            
            <h1 class="fw-bold h2">Libro de Reclamaciones Virtual</h1>
            <p class="mb-0 opacity-75 small">Dirección de Educación y Doctrina de la PNP - 2026</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="form-card p-4 p-md-5 shadow-sm">
                    
                    <livewire:reclamo-publico />

                </div>
            </div>
        </div>
    </div>

    <footer class="footer-text">
        <div class="container">
            <hr class="mb-4 opacity-25">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <span class="mb-2 mb-md-0">&copy; Desarrollado por UNITIC-DIREDDOC</span>
                <a href="{{ route('login') }}" class="admin-link mt-2 mt-md-0">
                    <i class="bi bi-shield-lock me-1"></i> Acceso Administrativo
                </a>
            </div>
        </div>
    </footer>

    @livewireScripts

</body>
</html>