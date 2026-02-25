   // Carrega Blocos e Tipos ao iniciar
    async function iniciar() {
        try {
            // Buscar Blocos
            const resB = await fetch('api/localizacoes.php?acao=listar_blocos');
            const blocos = await resB.json();
            const selB = document.getElementById('selectBloco');
            blocos.forEach(b => {
                selB.innerHTML += `<option value="${b.id_bloco}">${b.nome}</option>`;
            });

            // Buscar Tipos
            const resT = await fetch('api/localizacoes.php?acao=listar_tipos');
            const tipos = await resT.json();
            const selT = document.getElementById('selectTipo');
            tipos.forEach(t => {
                selT.innerHTML += `<option value="${t.id_tipo}">${t.nome}</option>`;
            });
        } catch (error) {
            console.error("Erro ao carregar dados iniciais:", error);
        }
    }

    // Carrega Ambientes dinamicamente
    async function carregarAmbientes(id_bloco) {
        const selA = document.getElementById('selectAmbiente');
        if (!id_bloco) { 
            selA.innerHTML = '<option value="">Selecione o bloco primeiro...</option>';
            selA.disabled = true; 
            return; 
        }
        
        try {
            const res = await fetch(`api/localizacoes.php?acao=listar_ambientes&id_bloco=${id_bloco}`);
            const ambientes = await res.json();
            
            selA.innerHTML = '<option value="">Selecione a Sala...</option>';
            ambientes.forEach(a => {
                selA.innerHTML += `<option value="${a.id_ambiente}">${a.nome}</option>`;
            });
            selA.disabled = false;
        } catch (error) {
            console.error("Erro ao carregar ambientes:", error);
        }
    }

    // Envio do formulário
    document.getElementById('formChamado').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = new FormData();
        formData.append('id_ambiente', document.getElementById('selectAmbiente').value);
        formData.append('id_tipo', document.getElementById('selectTipo').value);
        formData.append('descricao', document.getElementById('descricao').value);
        
        const fotoFile = document.getElementById('foto').files[0];
        if (fotoFile) {
            formData.append('foto', fotoFile);
        }

        try {
            const response = await fetch('api/salvar_chamado.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                alert(result.message);
                window.location.href = 'solicitante_dashboard.php';
            } else {
                alert("Erro: " + result.message);
            }
        } catch (error) {
            alert("Erro na conexão com o servidor.");
        }
    });

    iniciar();