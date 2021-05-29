<?php
require_once '../vendor/autoload.php';
use App\Entity\Grupo;
use \App\Entity\GruposUsuario;
$obGrupoUser = new GruposUsuario;
$obGrupo = new Grupo;
session_start();
if(!isset($_SESSION['idUsuario'])){
  header("Location: formLogin.php");
  exit;
}else{
    $idUsuarioLogado = $_SESSION['idUsuario'];
}
//Verificar se clicou no botão 
if(isset($_GET['id'])){
    $obGrupoUser->idGrupo = addslashes($_GET['id']);
    $obGrupoUser->idUsuario = addslashes($idUsuarioLogado);
    $obGrupoSetado = $obGrupo->getGrupo($_GET['id']);
    $statusGrupo = $obGrupoSetado->flAtivo;

    if($statusGrupo == 's'):
        //Verificar se está preenchido
        if($obGrupoUser->participar())
        {
            header('location: inicio.php?status=success');
            exit;
        }else{
            header('location: inicio.php?status=error');
            exit;
        }
    else:
        header('location: inicio.php?status=error');
        exit;
    endif;
}
require_once '../includes/headerPages.php';
require_once '../includes/footer.php';