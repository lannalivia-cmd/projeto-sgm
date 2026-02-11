<?php

session_start();
require_once '../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor'){
     echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
 }

$sql = "SELECT * FROM chamados 
    inner join ambientes on chamados.id_ambiente = ambientes.id_ambiente 
    join usuarios on chamados.id_solicitante = usuarios.id_usuario;";
        
$res = $conn->query($sql);
$dados = $res->fetch_all(MYSQLI_ASSOC);
echo json_encode($dados);

?>
