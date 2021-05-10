<?php
require_once '../vendor/autoload.php';
require_once '../includes/headerPages.php';
use \App\Entity\GruposUsuario;
use \App\Entity\Grupo;
$obGrupoUser = new GruposUsuario;
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
        $obGrupoUser->idGrupo = addslashes($_GET['id']);
        $obGrupoUser->idUsuario = addslashes($idUsuarioLogado);
        //VALIDAÇÃO DO POST
        if(isset($_POST['excluir'])){
            //Verificar se está preenchido
            if($obGrupoUser->sair($obGrupoUser->idUsuario, $obGrupoUser->idGrupo))
            {
                header('location: inicio.php?status=success');
                exit;
            }else{
                header('location: inicio.php?status=error');
                exit;
            }

    }
}
    require_once '../includes/confirmarSairGrupo.php';
    require_once '../includes/footer.php';
?>