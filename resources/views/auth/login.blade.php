<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Libro de Reclamaciones - DIREDDOC PNP</title>
    <link rel="icon" href="{{ asset('images/direddoc.png') }}" type="image/png">

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
            background-color: var(--pnp-green-dark); /* Fondo oscuro elegante para login */
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: radial-gradient(circle at 50% 50%, #135835 0%, #0e4429 100%);
        }

        .login-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0,0,0,0.3);
            border: none;
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
        }

        .login-logo {
            height: 100px;
            width: auto;
            display: block;
            margin: 0 auto 1.5rem;
            filter: drop-shadow(0 4px 4px rgba(0,0,0,0.1));
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            border-color: var(--pnp-green);
            box-shadow: 0 0 0 0.25rem rgba(19, 88, 53, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-right: none;
            color: var(--pnp-green);
            border-radius: 8px 0 0 8px;
        }
        
        .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        .btn-login {
            background-color: var(--pnp-green);
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 50px;
            width: 100%;
            border: none;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background-color: var(--pnp-green-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(19, 88, 53, 0.4);
            color: white;
        }

        .back-link {
            color: #adb5bd;
            text-decoration: none;
            font-size: 0.85rem;
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            transition: color 0.3s;
        }

        .back-link:hover {
            color: var(--pnp-green);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <img src="{{ asset('images/direddoc.png') }}" alt="Logo DIREDDOC" class="login-logo">
        
        <h4 class="text-center fw-bold mb-1" style="color: var(--pnp-green-dark);">Acceso Administrativo</h4>
        <p class="text-center text-muted small mb-4">Sistema de Libro de Reclamaciones - 2026</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small rounded-3 mb-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label small fw-bold text-secondary">Correo Institucional</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" id="email" placeholder="usuario@pnp.gob.pe" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label small fw-bold text-secondary">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-key"></i></span>
                    <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn btn-login shadow-sm">
                Ingresar al Sistema
            </button>

            <a href="{{ url('/') }}" class="back-link">
                <i class="bi bi-arrow-left"></i> Volver al Inicio
            </a>
        </form>

        <div class="text-center mt-4 pt-3 border-top">
            <small class="text-muted" style="font-size: 0.7rem;">&copy; Desarrollado por UNITIC-DIREDDOC PNP</small>
        </div>
    </div>

</body>
</html>