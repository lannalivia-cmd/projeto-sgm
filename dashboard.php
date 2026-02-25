<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: Login.php");
    exit;

}
$perfil = $_SESSION['user_perfil'];
switch ($perfil) {
     case 'gestor':
        header ("location: gestor_dashboard.php");
        break;
        case 'tecnico':
            header ("location: tecnico_minhas_tarefas.php");
            break;
            case 'solicitante':
                header ("Location: solicitante_dashboard.php");
                break;
                 
}