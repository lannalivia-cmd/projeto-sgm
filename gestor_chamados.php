<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Gestão de Chamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0b6e70;
            --secondary-bg: #f8f9fa;
        }

        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar elegante */
        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }

        /* Estilização da Tabela e Cards */
        .main-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead {
            background-color: var(--secondary-bg);
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(11, 110, 112, 0.05);
            transition: 0.3s;
        }

        /* Badges e Status */
        .badge-status {
            padding: 0.5em 0.8em;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Filtros */
        .filter-btn {
            border-radius: 20px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
        }

        .id-pill {
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
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="gestor_dashboard.php">
                <i class="bi bi-gear-fill me-2"></i>SGM ADMIN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" href="gestor_chamados.php"><i class="bi bi-card-list me-1"></i> Chamados</a>
                    <a class="nav-link" href="gestor_locais.php"><i class="bi bi-geo-alt me-1"></i> Locais</a>
                    <a class="nav-link text-warning" href="api/logout.php"><i class="bi bi-box-arrow-right me-1"></i> Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark m-0"><i class="bi bi-tools me-2 text-primary"></i>Gerenciamento de Chamados</h2>
            <span class="badge bg-white text-dark border shadow-sm p-2 px-3 rounded-pill">
                <i class="bi bi-clock-history me-1"></i> Atualizado agora
            </span>
        </div>

        <div class="mb-4 d-flex flex-wrap gap-2">
            <button class="btn filter-btn btn-dark shadow-sm" onclick="carregarChamados('')">Todos</button>
            <button class="btn filter-btn btn-outline-primary shadow-sm bg-white" onclick="carregarChamados('aberto')">
                <i class="bi bi-envelope-open me-1"></i> Abertos
            </button>
            <button class="btn filter-btn btn-outline-warning shadow-sm bg-white" onclick="carregarChamados('em_execucao')">
                <i class="bi bi-play-circle me-1"></i> Em Execução
            </button>
            <button class="btn filter-btn btn-outline-success shadow-sm bg-white" onclick="carregarChamados('concluido')">
                <i class="bi bi-check2-all me-1"></i> Concluídos
            </button>
        </div>

        <div class="card main-card shadow-lg">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Solicitante</th>
                            <th>Localização</th>
                            <th>Prioridade</th>
                            <th>Técnico Responsável</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="tabelaGeral" class="border-top-0">
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalFoto" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg overflow-hidden">
                <div class="modal-body p-0 text-center bg-dark">
                    <img src="" id="imgModal" class="img-fluid" style="max-height: 80vh;">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Fechar Visualização</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const coresPrioridade = { 
            'urgente': 'text-danger', 
            'alta': 'text-warning', 
            'media': 'text-primary', 
            'baixa': 'text-secondary' 
        };
        
        const coresStatus = { 
            'aberto': 'bg-secondary', 
            'em_execucao': 'bg-warning text-dark', 
            'concluido': 'bg-success', 
            'fechado': 'bg-dark' 
        };

        async function carregarChamados(status = '') {
            try {
                const res = await fetch(`api/gestor_chamados.php?status=${status}`);
                const chamados = await res.json();
                const body = document.getElementById('tabelaGeral');

                body.innerHTML = chamados.map(c => `
                    <tr>
                        <td class="ps-4"><span class="id-pill">#${c.id_chamado}</span></td>
                        <td>
                            <div class="fw-bold">${c.solicitante_nome}</div>
                            <small class="text-muted">ID: ${c.id_usuario_solicitante || '---'}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>
                                <div>
                                    <div class="fw-bold">${c.ambiente_nome}</div>
                                    <small class="text-muted">${c.bloco_nome}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="fw-bold ${coresPrioridade[c.prioridade] || 'text-dark'}">
                                <i class="bi bi-reception-4 me-1"></i> ${c.prioridade.toUpperCase()}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge me-2 text-primary"></i>
                                <span>${c.tecnico_nome || '<em class="text-muted">Aguardando...</em>'}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-status ${coresStatus[c.status]} shadow-sm">
                                ${c.status.replace('_', ' ').toUpperCase()}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="gestor_detalhes.php?id=${c.id_chamado}" class="btn btn-sm btn-primary px-3 rounded-pill shadow-sm">
                                <i class="bi bi-gear-wide-connected me-1"></i> Gerenciar
                            </a>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error("Erro ao carregar chamados:", error);
            }
        }

        function verFoto(url) {
            document.getElementById('imgModal').src = url;
            new bootstrap.Modal(document.getElementById('modalFoto')).show();
        }

        // Inicializar
        carregarChamados();
    </script>
</body>
</html>