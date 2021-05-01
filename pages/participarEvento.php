<?php
require_once '../vendor/autoload.php';
use \App\Entity\EventosUsuario;
$obEventoUser = new EventosUsuario;
session_start();
if(!isset($_SESSION['idUsuario'])){
  header("Location: formLogin.php");
  exit;
}else{
    $idUsuarioLogado = $_SESSION['idUsuario'];
}
//Verificar se clicou no botão 
if(isset($_GET['id'])){
    $obEventoUser->idEvento = addslashes($_GET['id']);
    $obEventoUser->idUsuario = addslashes($idUsuarioLogado);
    //Verificar se está preenchido
    if($obEventoUser->participar())
    {
        header('location: eventosAbertos.php?status=success');
        exit;
    }else{
        header('location: inicioAbertos.php?status=error');
        exit;
    }
}
require_once '../includes/headerPages.php';
require_once '../includes/footer.php';