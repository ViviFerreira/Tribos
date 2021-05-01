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
    if($obEventoUser->sair($obEventoUser->idEvento, $obEventoUser->idUsuario))
    {
        header('location: eventosAbertos.php?status=success');
        exit;
    }else{
        header('location: eventosAbertos.ph?status=error');
        exit;
    }
}
