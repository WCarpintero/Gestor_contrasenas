<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - Secure Vault</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --accent-cyan: #06b6d4;
            --accent-emerald: #10b981;
            --dark-bg: #0f172a;
        }

        body {
            min-height: 100vh;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            color: #f8fafc;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1000px;
            display: flex;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        }

        /* PANEL IZQUIERDO */
        .login-left {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            flex: 1;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-left h2 {
            font-weight: 700;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            gap: 15px;
        }

        .feature-icon {
            color: var(--accent-cyan);
            font-size: 1.2rem;
        }

        .feature-text h6 {
            margin-bottom: 2px;
            font-weight: 600;
            color: #e2e8f0;
        }

        .feature-text p {
            font-size: 0.85rem;
            color: #94a3b8;
            margin: 0;
        }

        /* PANEL DERECHO */
        .login-right {
            background: #ffffff;
            flex: 1.2;
            padding: 50px 60px;
            color: #1e293b;
        }

        .login-right h4 {
            font-weight: 700;
            color: #0f172a;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 14px;
            border: 1.5px solid #e2e8f0;
            background-color: #f8fafc;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
            background-color: #fff;
        }

        /* Indicador de fuerza */
        .strength-meter {
            height: 4px;
            background: #e2e8f0;
            margin-top: 8px;
            border-radius: 2px;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            width: 40%;
            /* Dinámico */
            background: var(--accent-emerald);
            transition: width 0.3s ease;
        }

        .btn-register {
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-weight: 600;
            margin-top: 10px;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .link {
            text-decoration: none;
            color: var(--accent-cyan);
            font-weight: 600;
        }

        @media(max-width: 992px) {
            .login-left {
                display: none;
            }

            .login-wrapper {
                max-width: 500px;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">

        <div class="login-left">
            <h2>Crea tu Bóveda</h2>

            <div class="feature-item">
                <div class="feature-icon">✔</div>
                <div class="feature-text">
                    <h6>Cifrado Zero-Knowledge</h6>
                    <p>Solo tú tienes la llave. Nosotros nunca vemos tus datos.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon">✔</div>
                <div class="feature-text">
                    <h6>Acceso Multiplataforma</h6>
                    <p>Sincronización segura entre todos tus dispositivos.</p>
                </div>
            </div>

            <div class="feature-item">
                <div class="feature-icon">✔</div>
                <div class="feature-text">
                    <h6>Auditoría de Seguridad</h6>
                    <p>Alertas automáticas sobre contraseñas débiles o filtradas.</p>
                </div>
            </div>
        </div>

        <div class="login-right">
            <h4 class="mb-1">Configurar cuenta</h4>
            <p class="text-muted small mb-4">Empieza a proteger tu vida digital hoy mismo.</p>
            <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
            <div id="successMessage" class="alert alert-success" style="display:none;"></div>

            <form id="formRegistro">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" placeholder="Ej. Alex" name="nombre">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" class="form-control" placeholder="Ej. Pérez" name="apellido">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" placeholder="usuario@correo.com" name="correo">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label">Teléfono móvil</label>
                        <input type="tel" class="form-control" placeholder="+34 600 000 000" name="telefono">
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted" style="font-size: 0.75rem; display: block; margin-top: -10px;">
                            * Se usará para la recuperación de cuenta y seguridad 2FA.
                        </small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva contraseña</label>
                    <input type="password" class="form-control" placeholder="Mínimo 6 caracteres" name="master_key">
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" placeholder="Repite tu llave maestra" name="confirm_key">
                </div>

                <div class="d-grid mb-3">
                    <button class="btn btn-register">Crear mi Bóveda Gratis</button>
                </div>

                <div class="text-center">
                    <span class="text-muted small">¿Ya tienes una cuenta?</span>
                    <a href="index.php" class="link small ms-1">Iniciar sesión</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/registro.js"></script>
</body>

</html>