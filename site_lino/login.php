<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="login-container">
    <div class="login-image">
    </div>

    <div class="login-form">
        <div class="form-box">
            <h1>Bem-vindo!</h1>
            <p>Casas que respiram calma e natureza</p>

           <div class="login-form">
    

        <form action="./api/login.php" method="POST">
            <div class="input-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="input-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
            </div>

            
            <button type="submit">Entrar</button>
        </form>
        </div>
</div>
            
        </div>
    </div>
</div>

</body>
</html>
