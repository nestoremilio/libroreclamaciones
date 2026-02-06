<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Reclamo - PNP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', sans-serif;
        }

        .header-pnp {
            background: linear-gradient(135deg, #0c4b33 0%, #157347 100%);
            color: white;
            padding: 30px 0;
            box-shadow: 0 4px 15px rgba(12, 75, 51, 0.2);
        }

        .success-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border-top: 5px solid #198754;
            margin-top: 30px;
        }

        .code-box {
            background-color: #e8f5e9;
            border: 2px dashed #198754;
            color: #0c4b33;
            font-size: 1.5rem;
            font-weight: 800;
            padding: 15px;
            border-radius: 10px;
            letter-spacing: 1px;
            margin: 20px 0;
        }

        /* Estilos específicos para impresión */
        @media print {
            body {
                background-color: white;
            }

            .header-pnp,
            .btn-area {
                display: none;
            }

            /* Oculta botones y header decorativo */
            .success-card {
                box-shadow: none;
                border: 1px solid #ddd;
                margin-top: 0;
            }

            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
            }

            .print-footer {
                display: block !important;
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="header-pnp text-center">
        <div class="container">
            <h3 class="fw-bold mb-0">Libro de Reclamaciones Virtual</h3>
            <small>Policía Nacional del Perú</small>
        </div>
    </div>

    <div class="print-header d-none">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/Insignia_de_la_Polic%C3%ADa_Nacional_del_Per%C3%BA.png"
            width="80" alt="Logo PNP">
        <h3>CONSTANCIA DE REGISTRO</h3>
        <p>Unidad de Tecnología de la Información y Comunicaciones</p>
    </div>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="success-card p-5 text-center">

                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>

                    <h2 class="fw-bold text-dark mb-3">¡Registrado Exitosamente!</h2>
                    <p class="text-muted mb-4">Su reclamo o queja ha sido ingresado al sistema correctamente. Utilice el
                        siguiente código para realizar el seguimiento.</p>

                    <label class="text-uppercase fw-bold text-secondary small">Código de Seguimiento:</label>
                    <div class="code-box">
                        {{ $codigo }}
                    </div>

                    <p class="small text-muted mb-4">
                        <i class="bi bi-info-circle me-1"></i>
                        Guarde este código. Se ha enviado una copia a su correo electrónico.
                    </p>

                    <div class="btn-area d-grid gap-2 d-md-flex justify-content-center">
                        <button onclick="window.print()" class="btn btn-outline-dark px-4">
                            <i class="bi bi-printer-fill me-2"></i> Imprimir / Guardar PDF
                        </button>
                        <a href="{{ url('/') }}" class="btn btn-success px-5">
                            Volver al Inicio
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="print-footer d-none">
        <p>Este documento es una constancia generada electrónicamente por el Sistema de Reclamaciones de la PNP. Fecha
            de impresión: {{ date('d/m/Y H:i') }}</p>
    </div>

</body>

</html>