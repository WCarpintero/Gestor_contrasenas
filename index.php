<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Secure Vault</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --accent-cyan: #06b6d4;
            --accent-emerald: #10b981;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
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
            max-width: 950px;
            display: flex;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
        }

        /* PANEL IZQUIERDO: Enfocado en Seguridad */
        .login-left {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            flex: 1.2;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .shield-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, var(--accent-cyan), var(--accent-emerald));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-left h2 {
            font-weight: 700;
            font-size: 2.2rem;
            color: #fff;
        }

        .login-left p {
            color: #94a3b8;
            font-size: 1rem;
            line-height: 1.7;
        }

        /* PANEL DERECHO: Formulario */
        .login-right {
            background: #ffffff;
            flex: 1;
            padding: 60px;
            color: #1e293b;
        }

        .login-right h4 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.85rem;
            color: #64748b;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
        }

        .btn-login {
            background: #0f172a;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: #1e293b;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .link {
            text-decoration: none;
            color: var(--accent-cyan);
            font-weight: 600;
        }

        .link:hover {
            color: #0891b2;
            text-decoration: underline;
        }

        .security-badge {
            display: inline-block;
            padding: 4px 12px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-emerald);
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        @media(max-width: 992px){
            .login-left { display: none; }
            .login-wrapper { max-width: 450px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <div class="login-left">
        <div class="shield-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915V10a.5.5 0 0 1-1 0V7.915A1.5 1.5 0 0 1 8 5"/>
            </svg>
        </div>
        <h2>Secure Vault</h2>
        <div class="security-badge">AES-256 ENCRYPTION</div>
        <p class="mt-2">
            Accede a tu bóveda personal. Tus contraseñas están cifradas localmente antes de salir de tu dispositivo.
        </p>
    </div>

    <div class="login-right">
        <div class="mb-4 text-center text-lg-start">
            <h4>Identificación</h4>
            <p class="text-muted small">Descifra tu bóveda para continuar.</p>
        </div>

        <form id="formLogin">
            <div class="mb-3">
                <label class="form-label">Usuario o Email</label>
                <input type="email" class="form-control" placeholder="admin@vault.io" name="correo" id="correo">
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between">
                    <label class="form-label">Llave Maestra</label>
                    <a href="#" class="small text-muted text-decoration-none">¿Olvidaste tu llave?</a>
                </div>
                <input type="password" class="form-control" placeholder="••••••••••••" name="contrasena" id="contrasena">
            </div>

            <div class="d-grid mb-4">
                <button class="btn btn-login">Desbloquear Bóveda</button>
            </div>

            <div class="text-center">
                <span class="text-muted small">¿No tienes una bóveda?</span>
                <a href="registro" class="link small ms-1">Empezar ahora</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>