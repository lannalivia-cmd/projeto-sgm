<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM | Abrir Chamado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary-color: #0b6e70;
            --dark-color: #085152;
        }

        body { 
            background: linear-gradient(135deg, #f4f7f6 0%, #e9ecef 100%);
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
        }

        /* Navbar para manter o padrão */
        .custom-navbar {
            background-color: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Card de Formulário */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            background: white;
            overflow: hidden;
            max-width: 650px;
            margin: 40px auto;
        }

        .card-header-custom {
            background-color: var(--primary-color);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(11, 110, 112, 0.15);
        }

        /* Botão Enviar */
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background-color: var(--dark-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(11, 110, 112, 0.3);
        }

        /* Preview da Foto */
        #preview-container {
            display: none;
            margin-top: 15px;
            text-align: center;
        }

        #image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 12px;
            border: 3px solid #f8f9fa;
        }
    </style>
</head>
<body>

    <header>
        <nav class="navbar custom-navbar navbar-dark mb-4">
            <div class="container">
                <a class="navbar-brand fw-bold" href="solicitante_dashboard.php">
                    <i class="bi bi-arrow-left-circle me-2"></i>SGM | NOVO CHAMADO
                </a>
            </div>
        </nav>
    </header>

    <main class="container px-3">
        <div class="form-card">
            <div class="card-header-custom">
                <h4 class="mb-1 fw-bold">Descreva o Problema</h4>
                <p class="mb-0 opacity-75 small">Preencha os detalhes abaixo para que nossa equipe possa ajudar.</p>
            </div>
            
            <form id="formChamado" class="card-body p-4 p-md-5">
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-building text-primary"></i> Bloco</label>
                        <select id="selectBloco" class="form-select" required onchange="carregarAmbientes(this.value)">
                            <option value="">Selecione o bloco</option>
                        </select>
    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label"><i class="bi bi-geo-alt text-primary"></i> Ambiente/Sala</label>
                        <select id="selectAmbiente" class="form-select" required>
                            <option value="">Selecione o Ambiente</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-tools text-primary"></i> Tipo de Serviço</label>
                    <select id="selectTipo" class="form-select" required>
                        <option value="">Selecione o tipo de manutenção...</option>
                        <option value="eletrica">Elétrica</option>
                        <option value="hidraulica">Hidráulica</option>
                        <option value="predial">Manutenção Predial</option>
                        <option value="ti">TI / Infraestrutura</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-pencil-square text-primary"></i> Descrição Detalhada</label>
                    <textarea id="descricao" class="form-control" rows="4" required 
                        placeholder="Ex: A torneira da pia está com vazamento constante mesmo fechada."></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label"><i class="bi bi-camera text-primary"></i> Foto da Ocorrência (Opcional)</label>
                    <input type="file" id="foto" class="form-control" accept="image/*" onchange="previewImage(event)">
                    
                    <div id="preview-container">
                        <p class="small text-muted mb-1">Visualização do anexo:</p>
                        <img id="image-preview" src="#" alt="Preview">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn btn-primary btn-submit w-100 shadow-sm">
                        <i class="bi bi-send-fill me-2"></i> ENVIAR SOLICITAÇÃO
                    </button>
                    <a href="solicitante_dashboard.php" class="btn btn-link w-100 mt-3 text-muted text-decoration-none small">
                        Cancelar e voltar
                    </a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Função para mostrar a foto antes de enviar
        function previewImage(event) {
            const reader = new FileReader();
            const preview = document.getElementById('image-preview');
            const container = document.getElementById('preview-container');
            
            reader.onload = function() {
                preview.src = reader.result;
                container.style.display = 'block';
            }
            
            if(event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Simulação de carregamento de blocos (Você já deve ter isso no seu .js externo)
        // Aqui apenas para exemplo visual
        const selectBloco = document.getElementById('selectBloco');
        const blocos = ["Bloco Administrativo", "Bloco A", "Bloco B", "Pátio Central"];
        blocos.forEach(b => {
            let opt = document.createElement('option');
            opt.value = b;
            opt.innerHTML = b;
            selectBloco.appendChild(opt);
        });
    </script>
    
    <script src="./assets/js/solicitante_abrir_chamado.js"></script>
</body>
</html>