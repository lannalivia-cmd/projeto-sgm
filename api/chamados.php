<?php
session_start();
require_once '../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

$sql = "SELECT 
            c.id_chamado, 
            a.nome as ambiente, 
            c.descricao_problema, 
            c.data_abertura, 
            c.status 
        FROM chamados c
        INNER JOIN ambientes a ON a.id_ambiente = c.id_ambiente;";

$res = $conn->query($sql);


if (!$res) {
    echo json_encode(["success" => false, "error" => $conn->error]);
    exit;
}

$dados = $res->fetch_all(MYSQLI_ASSOC);

echo json_encode($dados);