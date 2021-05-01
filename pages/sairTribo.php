<?php
require_once '../vendor/autoload.php';
use \App\Entity\GruposUsuario;
$obGrupoUser = new GruposUsuario;
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
