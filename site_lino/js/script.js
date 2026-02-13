document.getElementById('fromLogin').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const email = document.getElementById('email').value;
    const senha = document.getElementById('cpf').value;
    const msg = document.getElementById('mensagem');

    try {
        const response = await fetch('api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email, cpf: cpf })
        });

        // Debug: Veja o que o PHP está retornando no console do navegador (F12)
        const textoRetorno = await response.text();
        console.log("Resposta do Servidor:", textoRetorno);
        
        const result = JSON.parse(textoRetorno);

        if (result.success) {
            // Se o login funcionar, manda para o dashboard que criamos
            window.location.href = 'usuario.php';
        } else {
            msg.innerText = result.message;
        }
    } catch (error) {
        console.error("Erro na requisição:", error);
        msg.innerText = "Erro ao conectar com o servidor.";
    }
});