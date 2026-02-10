<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PNP</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --pnp-green: #135835;
            --pnp-green-dark: #0e4429;
            --pnp-gray: #6c757d;
        }

        body {
            background: linear-gradient(135deg, var(--pnp-green) 0%, #082d1f 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-icon {
            font-size: 3.5rem;
            color: var(--pnp-green);
            margin-bottom: 0.5rem;
            display: inline-block;
        }
        
        .form-control {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }
        
        .form-control:focus {
            border-color: var(--pnp-green);
            box-shadow: 0 0 0 0.25rem rgba(19, 88, 53, 0.25);
        }

        .btn-login {
            background-color: var(--pnp-green);
            color: white;
            padding: 0.8rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
            border: none;
        }

        .btn-login:hover {
            background-color: var(--pnp-green-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(19, 88, 53, 0.3);
            color: white;
        }

        .footer-login {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.8rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container px-4">
        <div class="login-card mx-auto">
            <div class="login-header">
                <i class="bi bi-shield-lock-fill login-icon"></i>
                <h3 class="fw-bold mb-1" style="color: var(--pnp-green-dark);">Acceso Administrativo</h3>
                <p class="text-muted small mb-0">Sistema de Libro de Reclamaciones</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger py-2 small rounded-3">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Correo Institucional</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-envelope text-secondary"></i></span>
                        <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="usuario@pnp.gob.pe" required autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-key text-secondary"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" required>
                    </div>
                </div>
                
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-login">
                        Ingresar al Sistema
                    </button>
                </div>
                
                <div class="footer-login">
                    <a href="{{ url('/') }}" class="text-decoration-none small text-secondary">
                        <i class="bi bi-arrow-left"></i> Volver al Inicio
                    </a>
                </div>
            </form>
        </div>
        <p class="text-center text-white-50 mt-4 small">&copy; 2026 Dirección de Educación y Doctrina - PNP</p>
    </div>
</body>
</html>