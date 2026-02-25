<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}
$id = $_GET['id'] ?? 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Gerenciar Chamado #<?= $id ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #0b6e70;
            --secondary-color: #085152;
            --accent-color: #ffca2c;
        }

        body { 
            background-color: #f4f7f6; 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .navbar-custom {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .card {
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .card-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .info-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 2px;
            display: block;
        }

        .info-value {
            font-weight: 500;
            color: #2d3436;
            margin-bottom: 15px;
            display: block;
        }

        .thumb-img {
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
            border: 2px solid transparent;
        }

        .thumb-img:hover {
            transform: scale(1.05);
            border-color: var(--primary-color);
        }

        .btn-atribuir {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            padding: 12px;
        }

        .btn-atribuir:hover {
            background-color: var(--secondary-color);
        }

        .status-pill {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header class="navbar-custom mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <span class="fs-5 fw-bold"><i class="bi bi-gear-fill me-2"></i>Gestão de O.S. #<?= $id ?></span>
        <a href="gestor_chamados.php" class="btn btn-light btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Voltar à Lista
        </a>
    </div>
</header>

<main class="container">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-info-circle me-2 text-primary"></i>Detalhes da Solicitação</span>
                    <span id="statusBadge"></span>
                </div>
                <div class="card-body" id="detalhesChamado">
                    <div class="text-center p-5">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>

            <div id="areaFechamento"></div>
        </div>

        <div class="col-lg-5">
            <div class="card shadow-sm border-top border-4 border-primary">
                <div class="card-header bg-white">
                    <i class="bi bi-person-badge me-2 text-primary"></i>Triagem e Atribuição
                </div>
                <div class="card-body">
                    <form id="formAtribuir">
                        <div class="mb-4">
                            <label class="info-label"><i class="bi bi-wrench-adjustable me-1"></i>Técnico Responsável</label>
                            <select id="selectTecnico" class="form-select form-select-lg shadow-sm" style="font-size: 1rem;" required></select>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="info-label"><i class="bi bi-flag me-1"></i>Prioridade</label>
                                <select id="prioridade" class="form-select shadow-sm">
                                    <option value="baixa">Baixa</option>
                                    <option value="media">Média</option>
                                    <option value="alta">Alta</option>
                                    <option value="urgente">Urgente</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="info-label"><i class="bi bi-calendar-event me-1"></i>Data Prevista</label>
                                <input type="date" id="data_prevista" class="form-control shadow-sm" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-atribuir w-100 shadow">
                            Atualizar Chamado
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="mt-4 p-3 bg-light rounded shadow-sm border-start border-4 border-warning">
                <small class="text-muted d-block">Nota para o Gestor:</small>
                <small>Ao atribuir um técnico, ele receberá uma notificação automática para iniciar o atendimento.</small>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modalFoto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg bg-dark">
            <div class="modal-body p-0 text-center">
                <img src="" id="imgModal" class="img-fluid rounded-top">
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-light rounded-pill" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const coresStatus = { 
        'aberto': 'bg-secondary text-white', 
        'em_execucao': 'bg-warning text-dark', 
        'concluido': 'bg-success text-white', 
        'fechado': 'bg-dark text-white' 
    };

    function verFoto(url) {
        document.getElementById('imgModal').src = url;
        new bootstrap.Modal(document.getElementById('modalFoto')).show();
    }

    async function carregarDados() {
        // Carrega Técnicos
        const resTec = await fetch('api/usuarios.php');
        const tecnicos = await resTec.json();
        const select = document.getElementById('selectTecnico');
        select.innerHTML = '<option value="">Selecione um técnico profissional...</option>';
        tecnicos.forEach(t => select.innerHTML += `<option value="${t.id_usuario}">${t.nome}</option>`);

        // Carrega Chamado
        const c = await (await fetch(`api/chamados.php?id=<?= $id ?>`)).json();
        
        document.getElementById('statusBadge').innerHTML = `<span class="status-pill ${coresStatus[c.status]}">${c.status.toUpperCase()}</span>`;
        
        document.getElementById('detalhesChamado').innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label class="info-label">Solicitante</label>
                    <span class="info-value"><i class="bi bi-person me-2"></i>${c.solicitante_nome}</span>
                    
                    <label class="info-label">Localização</label>
                    <span class="info-value"><i class="bi bi-geo-alt me-2 text-danger"></i>${c.bloco_nome} - ${c.ambiente_nome}</span>
                </div>
                <div class="col-md-6">
                    <label class="info-label">Data de Abertura</label>
                    <span class="info-value"><i class="bi bi-clock me-2"></i>${new Date(c.data_abertura).toLocaleString()}</span>
                    
                    <label class="info-label">Tipo de Manutenção</label>
                    <span class="info-value"><i class="bi bi-tag me-2"></i>Elétrica / Predial</span>
                </div>
                <div class="col-12 mt-2">
                    <label class="info-label">Descrição do Problema</label>
                    <div class="p-3 bg-light rounded border mb-4">${c.descricao_problema}</div>
                </div>
            </div>
            <div id="fotosContainer"></div>
        `;

        if(c.id_tecnico) document.getElementById('selectTecnico').value = c.id_tecnico;
        if(c.prioridade) document.getElementById('prioridade').value = c.prioridade;
        if(c.data_previsao_conclusao) document.getElementById('data_prevista').value = c.data_previsao_conclusao;

        // Carrega Fotos (Anexos)
        const anexos = await (await fetch(`api/anexos.php?id_chamado=<?= $id ?>`)).json();
        if(anexos.length > 0) {
            let htmlFotos = '<label class="info-label mt-3">Evidências e Fotos</label><div class="row g-2">';
            anexos.forEach(arq => {
                htmlFotos += `
                    <div class="col-3 text-center mb-3">
                        <img src="${arq.caminho_arquivo}" class="thumb-img w-100 shadow-sm" onclick="verFoto('${arq.caminho_arquivo}')">
                        <small class="text-muted" style="font-size: 0.7rem;">${arq.tipo_anexo === 'abertura' ? 'ABERTURA' : 'CONCLUSÃO'}</small>
                    </div>`;
            });
            document.getElementById('fotosContainer').innerHTML = htmlFotos + '</div>';
        }

        // Botões de Status e Fechamento
        const area = document.getElementById('areaFechamento');
        if (c.status === 'concluido') {
            area.innerHTML = `
                <div class="card shadow border-start border-4 border-success">
                    <div class="card-body bg-light">
                        <h6 class="text-success fw-bold"><i class="bi bi-check-circle-fill me-2"></i>Serviço Finalizado pelo Técnico</h6>
                        <p class="small mb-3 text-muted"><strong>Laudo:</strong> ${c.solucao_tecnica || 'Nenhum detalhe informado.'}</p>
                        <button onclick="alterarStatusOS(<?= $id ?>, 'fechar')" class="btn btn-success w-100 fw-bold">VALIDAR E FECHAR O.S.</button>
                    </div>
                </div>`;
        } else if (c.status === 'fechado') {
            area.innerHTML = `<button onclick="alterarStatusOS(<?= $id ?>, 'reabrir')" class="btn btn-outline-warning w-100 fw-bold shadow-sm">REABRIR CHAMADO</button>`;
        }
    }

    async function alterarStatusOS(id, acao) {
        if(!confirm("Confirmar alteração de status?")) return;
        const res = await fetch('api/gestor_acoes.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ id_chamado: id, acao: acao })
        });
        if((await res.json()).success) location.reload();
    }

    document.getElementById('formAtribuir').onsubmit = async (e) => {
        e.preventDefault();
        const res = await fetch('api/atribuir_chamado.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                id_chamado: <?= $id ?>,
                id_tecnico: document.getElementById('selectTecnico').value,
                prioridade: document.getElementById('prioridade').value,
                data_prevista: document.getElementById('data_prevista').value
            })
        });
        if((await res.json()).success) window.location.href = 'gestor_chamados.php';
    };

    carregarDados();
</script>
</body>
</html>