<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Secure Vault</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 280px;
            --dark-navy: #0f172a;
            --accent-cyan: #06b6d4;
            --glass-bg: rgba(30, 41, 59, 0.7);
            /* Nuevas variables de contraste */
            --text-main: #f8fafc;
            --text-muted: #cbd5e1;
            /* Gris mucho más claro para legibilidad */
            --input-bg: #1e293b;
        }

        body {
            background-color: #0b0f1a;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Ajuste de textos silenciados globales */
        .text-muted {
            color: var(--text-muted) !important;
        }

        /* SIDEBAR */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--dark-navy);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem 1.5rem;
            z-index: 1000;
        }

        .nav-link {
            color: var(--text-muted);
            /* Mejorado de #94a3b8 */
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(6, 182, 212, 0.15);
            color: var(--accent-cyan);
        }

        /* MAIN CONTENT */
        main {
            margin-left: var(--sidebar-width);
            padding: 2rem;
        }

        /* BUSCADOR CORREGIDO */
        .search-bar {
            background: var(--input-bg) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 0 12px 12px 0 !important;
            color: white !important;
            padding: 12px 20px;
        }

        .search-bar::placeholder {
            color: #94a3b8;
        }

        .input-group-text {
            background: var(--input-bg) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 12px 0 0 12px !important;
        }

        /* TARJETAS DE CONTRASEÑA */
        .vault-card {
            background: var(--glass-bg);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .vault-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border-color: var(--accent-cyan);
        }

        .category-badge {
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-main);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-add {
            background: var(--accent-cyan);
            color: var(--dark-navy);
            font-weight: 700;
            border-radius: 10px;
            padding: 10px 24px;
            border: none;
        }

        .btn-add:hover {
            background: #22d3ee;
            color: var(--dark-navy);
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.4);
        }

        /* Botones de acción en tarjetas */
        .btn-outline-info {
            color: var(--accent-cyan);
            border-color: var(--accent-cyan);
        }

        .btn-outline-info:hover {
            background-color: var(--accent-cyan);
            color: var(--dark-navy);
        }
    </style>
</head>

<body>

    <nav id="sidebar">
        <div class="d-flex align-items-center mb-5">
            <i class="bi bi-shield-lock-fill fs-3 text-info me-2"></i>
            <h4 class="mb-0 fw-bold">SecureVault</h4>
        </div>

        <div class="nav flex-column">
            <a href="#" class="nav-link active"><i class="bi bi-safe2 me-2"></i> Todas las cuentas</a>
            <a href="#" class="nav-link"><i class="bi bi-star me-2"></i> Favoritos</a>
            <a href="#" class="nav-link"><i class="bi bi-credit-card me-2"></i> Tarjetas</a>
            <a href="#" class="nav-link"><i class="bi bi-sticky me-2"></i> Notas seguras</a>
            <hr class="opacity-10" style="background-color: white;">
            <a href="#" class="nav-link"><i class="bi bi-gear me-2"></i> Configuración</a>
            <a href="logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-left me-2"></i> Cerrar
                Sesión</a>
        </div>
    </nav>

    <main>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-bold">Mi Bóveda</h2>
                <p class="text-muted">Tienes 12 elementos almacenados</p>
            </div>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#modalNueva">
                <i class="bi bi-plus-lg me-2"></i> Nuevo Elemento
            </button>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search text-info"></i>
                    </span>
                    <input type="text" class="form-control search-bar"
                        placeholder="Buscar sitio, usuario o categoría...">
                </div>
            </div>
        </div>

        <div class="row g-4" id="vaultContainer">
            <div class="col-md-4">
                <div class="vault-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 44px; height: 44px;">
                                <i class="bi bi-play-fill text-white fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Netflix</h6>
                                <span class="category-badge">Entretenimiento</span>
                            </div>
                        </div>
                        <button class="btn btn-sm text-white-50"><i class="bi bi-three-dots-vertical fs-5"></i></button>
                    </div>
                    <div class="mb-4">
                        <label class="text-muted small d-block mb-1">Usuario</label>
                        <span class="fw-medium">alex.perez@email.com</span>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-info btn-sm flex-fill py-2">
                            <i class="bi bi-copy me-1"></i> Copiar
                        </button>
                        <button class="btn btn-outline-secondary btn-sm flex-fill py-2 text-white border-secondary">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="vault-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                style="width: 44px; height: 44px;">
                                <i class="bi bi-google text-white fs-5"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Google / Gmail</h6>
                                <span class="category-badge">Trabajo</span>
                            </div>
                        </div>
                        <button class="btn btn-sm text-white-50"><i class="bi bi-three-dots-vertical fs-5"></i></button>
                    </div>
                    <div class="mb-4">
                        <label class="text-muted small d-block mb-1">Usuario</label>
                        <span class="fw-medium">aperez.dev@gmail.com</span>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-info btn-sm flex-fill py-2">
                            <i class="bi bi-copy me-1"></i> Copiar
                        </button>
                        <button class="btn btn-outline-secondary btn-sm flex-fill py-2 text-white border-secondary">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalNueva" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark border-secondary">
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title text-info"><i class="bi bi-plus-circle me-2"></i>Nuevo Elemento</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formRegistro">
                            
                            <div class="mb-3">
                                <label class="form-label text-muted">Nombre del Sitio/Servicio</label>
                                <input type="text" name="sitio" class="form-control bg-dark text-white border-secondary"
                                    placeholder="Ej. Spotify" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Usuario / Email</label>
                                <input type="text" name="usuario"
                                    class="form-control bg-dark text-white border-secondary" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" id="inputPass" name="password"
                                        class="form-control bg-dark text-white border-secondary" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePass">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Categoría</label>
                                <select name="categoria" id="select_categoria"
                                    class="form-select bg-dark text-white border-secondary">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-muted">Notas Adicionales</label>
                                <textarea name="notas" class="form-control bg-dark text-white border-secondary" rows="3"
                                    placeholder="Preguntas de seguridad, fechas de vencimiento, etc."></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formRegistro" class="btn btn-add">Guardar Cambios</button>
                    </div>
                </div>
            </div>
        </div>

    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/gestor.js"></script>
</body>

</html>