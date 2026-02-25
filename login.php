<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body { 
            /* Atualizado para usar a sua imagem de manutenção elétrica */
            background: linear-gradient(rgba(11, 110, 112, 0.7), rgba(11, 110, 112, 0.7)), 
                        url('image_150fdb.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex; 
            align-items: center; 
            height: 100vh; 
            margin: 0;
        }

        .login-card { 
            width: 100%; 
            max-width: 400px; 
            margin: auto; 
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border: none;
            border-radius: 15px;
        }

        .btn-primary {
            background-color: #0b6e70;
            border-color: #0b6e70;
        }

        h3 {
            color: #0b6e70;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="login-card p-4 shadow-lg">
        <div class="text-center mb-4">
            <i class="bi bi-lightning-charge-fill" style="font-size: 2.5rem; color: #0b6e70;"></i>
            <h3 class="mt-2">SGM - Acesso</h3>
            <p class="text-muted small">Gestão de Manutenção Elétrica</p>
        </div>

        <form id="formLogin">
            <div class="mb-3">
                <label class="form-label font-weight-bold">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                    <input type="email" id="email" class="form-control" placeholder="usuario@empresa.com" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label font-weight-bold">Senha</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                    <input type="password" id="senha" class="form-control" placeholder="Sua senha" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 shadow-sm">Entrar no Sistema</button>
            <div id="mensagem" class="mt-3 text-center text-danger small"></div>
        </form>
    </div>

    <script src="assets/js/login.js"></
    </body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    </html>