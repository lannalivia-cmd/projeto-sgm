<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Painel Gestor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #0b6e70;
            --dark-color: #085152;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body { 
            background: linear-gradient(rgba(11, 110, 112, 0.85), rgba(11, 110, 112, 0.85)), 
                        url('image_150fdb.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Navbar Customizada */
        .navbar {
            background-color: var(--glass-bg) !important;
            backdrop-filter: blur(10px);
            border-bottom: 3px solid #ffca2c; /* Detalhe em amarelo para manutenção */
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 800;
            letter-spacing: 1px;
        }

        /* Cards de Indicadores */
        .stat-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.3;
            position: absolute;
            right: 15px;
            bottom: 10px;
        }

        /* Botões de Ação */
        .action-card {
            background: var(--glass-bg);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
            padding: 40px;
        }

        .btn-manage {
            padding: 15px 30px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
        }

        .btn-primary-custom:hover {
            background-color: var(--dark-color);
            color: white;
            transform: scale(1.02);
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-light mb-5">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-gear-fill me-2"></i>SGM | GESTÃO ADMINISTRATIVA
                </a>
                <div class="d-flex align-items-center">
                    <span class="me-3 d-none d-md-inline text-muted small">Bem-vindo, Gestor</span>
                    <button class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right"></i> Sair</button>
                </div>
            </div>
        </nav>
    </header>

    <main class="container">
        <div class="row g-4 justify-content-center mb-5">
            <div class="col-md-4">
                <div class="card stat-card bg-success text-white h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold mb-3">Novas Solicitações</h6>
                        <h2 class="display-4 fw-bold">0</h2>
                        <i class="bi bi-plus-circle-dotted stat-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-warning text-dark h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold mb-3">Em Atendimento</h6>
                        <h2 class="display-4 fw-bold">0</h2>
                        <i class="bi bi-tools stat-icon"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-danger text-white h-100 shadow-sm">
                    <div class="card-body">
                        <h6 class="text-uppercase fw-bold mb-3">Críticos / Urgentes</h6>
                        <h2 class="display-4 fw-bold">0</h2>
                        <i class="bi bi-exclamation-triangle-fill stat-icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="action-card shadow-lg text-center">
                    <h4 class="mb-4 text-dark fw-bold">Centro de Operações</h4>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <a href="./gestor_chamados.php" class="text-decoration-none">
                                <div class="btn btn-primary-custom btn-manage w-100 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-list-check fs-4"></i>
                                    <span>GERENCIAR CHAMADOS</span>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-5">
                            <button class="btn btn-outline-secondary btn-manage w-100 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-geo-alt-fill fs-4"></i>
                                <span>MAPA DE LOCALIZAÇÕES</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-center text-white mt-5 opacity-75">
        <small>&copy; 2026 SGM - Sistema de Gestão de Manutenção</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>