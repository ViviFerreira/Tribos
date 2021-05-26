<?php
require_once '../vendor/autoload.php';
require_once '../includes/headerPages.php';
use \App\Entity\Grupo;
$obGrupo = new Grupo;
session_start();
if(!isset($_SESSION['idUsuario'])){
  header("Location: formLogin.php");
  exit;
}else{
    $idUsuarioLogado = $_SESSION['idUsuario'];
}
//VALIDAÇÃO DO ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
        header('location: index.php?status=error');
        exit;
    }else{ 
        //CONSULTA O GRUPO
        $obGrupo = $obGrupo->getGrupo($_GET['id']);

        //VALIDAÇÃO DO POST
        if(isset($_POST['inativar'])){
            // Preenche campo para inativar
            $obGrupo->flAtivo = addslashes("n");
            //Verificar se está preenchido
            if($obGrupo->inativar())
            {
                header('location: inicio.php?status=success');
                exit;
            }else{
                header('location: inicio.php?status=error');
                exit;
            }

    }
}
    require_once '../includes/confirmarInativarGrupo.php';
    require_once '../includes/footer.php';
?>