<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Libro de Reclamaciones - DIREDDOC PNP</title>
    <link rel="icon" href="{{ asset('images/direddoc.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @livewireStyles

    <style>
        :root {
            --pnp-green: #135835;
            --pnp-green-dark: #0e4429;
            --pnp-green-light: #e8f5e9;
            --pnp-gray: #6c757d;
            --bg-light: #f0f4f8;
        }

        * { box-sizing: border-box; }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =====================
           HEADER
        ===================== */
        .header-pnp {
            background: linear-gradient(150deg, var(--pnp-green) 0%, var(--pnp-green-dark) 100%);
            color: white;
            padding: 48px 0 100px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Decoración geométrica de fondo */
        .header-pnp::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 260px; height: 260px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }

        .header-pnp::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .header-logo {
            height: 110px;
            width: auto;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.25));
            position: relative;
            z-index: 1;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 50px;
            padding: 5px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin-bottom: 12px;
        }

        /* =====================
           TARJETA PRINCIPAL
        ===================== */
        .form-card {
            background: white;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            margin-top: -65px;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255,255,255,0.8);
        }

        /* =====================
           CAMPOS DE FORMULARIO
        ===================== */
        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.9rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #fafafa;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--pnp-green);
            box-shadow: 0 0 0 3px rgba(19, 88, 53, 0.12);
            background-color: white;
            outline: none;
        }

        .form-control::placeholder { color: #adb5bd; }

        .input-group-text {
            background-color: #f0f4f8;
            border: 1.5px solid #e2e8f0;
            border-right: none;
            color: var(--pnp-green);
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--pnp-green);
        }

        .form-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #495057;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }

        /* =====================
           SECCIÓN
        ===================== */
        .section-title {
            color: var(--pnp-green-dark);
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            font-size: 1rem;
        }

        .section-title .step-badge {
            background: var(--pnp-green);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* =====================
           BOTÓN PRINCIPAL
        ===================== */
        .btn-pnp {
            background: linear-gradient(135deg, var(--pnp-green) 0%, var(--pnp-green-dark) 100%);
            color: white;
            font-weight: 700;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            width: 100%;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .btn-pnp:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(19, 88, 53, 0.4);
            color: white;
        }

        .btn-pnp:active { transform: translateY(0); }

        /* =====================
           FOOTER
        ===================== */
        .footer-text {
            font-size: 0.82rem;
            color: var(--pnp-gray);
            text-align: center;
            padding: 24px 0 16px;
            margin-top: auto;
        }

        .admin-link {
            color: #adb5bd;
            text-decoration: none;
            font-size: 0.82rem;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .admin-link:hover { color: var(--pnp-green); }

        /* =====================
           RESPONSIVE
        ===================== */
        @media (max-width: 768px) {
            .header-pnp { padding: 32px 15px 80px; }
            .header-logo { height: 80px; }
            .form-card { border-radius: 14px; margin-top: -50px; }
        }
    </style>
</head>

<body>

    <header class="header-pnp">
        <div class="container position-relative" style="z-index:1;">
            <img src="{{ asset('images/direddoc.png') }}" alt="Logo DIREDDOC PNP" class="header-logo mb-3">

            <div class="header-badge text-white mb-2">
                <i class="bi bi-shield-check-fill"></i>
                Servicio Oficial — PNP DIREDDOC
            </div>

            <h1 class="fw-bold h3 mb-1">Libro de Reclamaciones Virtual</h1>
            <p class="mb-0 opacity-75 small">Dirección de Educación y Doctrina &nbsp;·&nbsp; 2026</p>
        </div>
    </header>

    <main class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="form-card p-4 p-md-5">
                    <livewire:reclamo-publico />
                </div>
            </div>
        </div>
    </main>

    <footer class="footer-text">
        <div class="container">
            <hr class="mb-4 opacity-15">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <span class="text-muted">&copy; Desarrollado por UNITIC-DIREDDOC &nbsp;·&nbsp; {{ now()->year }}</span>
                <a href="{{ route('login') }}" class="admin-link">
                    <i class="bi bi-shield-lock"></i> Acceso Administrativo
                </a>
            </div>
        </div>
    </footer>

    @livewireScripts

</body>
</html>
