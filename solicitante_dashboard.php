<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM | Painel do Solicitante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #0b6e70;
            --dark-color: #085152;
        }

        body { 
            background-color: #f4f7f6;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        /* Navbar Customizada */
        .custom-navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            color: white !important;
        }

        /* Tabela e Cards */
        .main-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }

        .table thead {
            background-color: #f8f9fa;
            color: var(--primary-color);
            text-transform: uppercase;
            font-size: 0.8rem;
            font-weight: 700;
        }

        /* Miniatura da Foto */
        .mini-thumb {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
            border: 1px solid #dee2e6;
        }

        .mini-thumb:hover {
            transform: scale(1.1);
        }

        /* Botão Novo Chamado */
        .btn-new {
            background-color: var(--primary-color);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }

        .btn-new:hover {
            background-color: var(--dark-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(11, 110, 112, 0.2);
        }

        .id-badge {
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 5px;
            font-family: monospace;
            font-weight: bold;
            color: var(--primary-color);
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar custom-navbar navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="bi bi-lightning-charge-fill me-2"></i>SGM | SOLICITANTE
                </a>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3 d-none d-md-inline">Olá, <strong>Solicitante</strong>!</span>
                    <a href="logout.php" class="btn btn-light btn-sm rounded-pill px-3 fw-bold">
                        <i class="bi bi-box-arrow-right me-1"></i> Sair
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h3 class="fw-bold text-dark mb-0">
                    <i class="bi bi-journal-text me-2 text-primary"></i>Minhas Solicitações
                </h3>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="solicitante_abrir_chamado.php" class="btn btn-new">
                    <i class="bi bi-plus-lg me-2"></i>NOVA SOLICITAÇÃO
                </a>
            </div>
        </div>

        <div class="card main-card shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Foto</th>
                            <th>Localização</th>
                            <th>Descrição do Problema</th>
                            <th>Data Abertura</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaChamados">
                        <tr>
                            <td class="ps-4"><span class="id-badge">#1</span></td>
                            <td><i class="bi bi-image text-muted fs-4"></i></td>
                            <td>
                                <div class="fw-bold">Recepção</div>
                                <small class="text-muted">Bloco Administrativo</small>
                            </td>
                            <td><span class="text-truncate d-inline-block" style="max-width: 250px;">Vazando água na lâmpada...</span></td>
                            <td>06/02/2026</td>
                            <td><span class="badge bg-dark rounded-pill px-3">FECHADO</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>