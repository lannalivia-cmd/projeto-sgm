<?php
session_start();
require_once 'login.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['cpf'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email_cliente = email_cliente");
    $stmt->execute(['email_cliente' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['cpf'])) {
        $_SESSION['usuario_logado'] = $user['id_cliente'];
        header("Location: ../dashboard.php"); 
    } else {
        header("Location: ../login.php?erro=invalido");
    }
}
?>