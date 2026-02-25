<?php
session_start();

// Se o usuário confirmou a saída via parâmetro na URL
if (isset($_GET['confirmar']) && $_GET['confirmar'] === 'true') {
    session_unset();
    session_destroy();
    // Redirecionamento via JS para evitar o erro de cabeçalho do PHP
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGM - Sair</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body { 
            background: linear-gradient(rgba(11, 110, 112, 0.9), rgba(11, 110, 112, 0.9)), 
                        url('image_150fdb.jpg'); 
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .confirm-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            text-align: center;
            max-width: 450px;
            width: 90%;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .icon-warning {
            font-size: 4rem;
            color: #ffca2c;
            margin-bottom: 1rem;
        }

        .btn-confirm {
            background-color: #0b6e70;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-confirm:hover {
            background-color: #085152;
            color: white;
            transform: scale(1.05);
        }

        .btn-cancel {
            background-color: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-cancel:hover {
            background-color: #e9ecef;
            color: #333;
        }

        h3 { color: #0b6e70; font-weight: 700; }
    </style>
</head>
<body>

    <div class="confirm-card shadow-lg">
        <div class="icon-warning">
            <i class="bi bi-exclamation-octagon-fill"></i>
        </div>
        
        <h3>Confirmar Saída?</h3>
        <p class="text-muted mb-4">Você tem certeza que deseja encerrar sua sessão no sistema SGM?</p>
        
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="logout.php?confirmar=true" class="btn btn-confirm">
                <i class="bi bi-check-lg"></i> Sim, desejo sair
            </a>
            
            <a href="gestor_dashboard.php" class="btn btn-cancel">
                <i class="bi bi-x-lg"></i> Não, continuar
            </a>
        </div>
    </div>

</body>
</html>