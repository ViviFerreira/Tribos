<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Grupo;
$obGrupo = new Grupo;

//VALIDAÇÃO DO ID
if(!isset($_GET['idUsuario']) or !is_numeric($_GET['idUsuario'])){
  header('location: index.php?status=error');
  exit;
}

//CONSULTA O GRUPO
$obGrupo = $obGrupo->getGrupo($_GET['idUsuario']);

//VALIDAÇÃO DO GRUPO
if(!$obGrupo instanceof Grupo){
  header('location: index.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){

  $obGrupo->excluir();

  header('location: inicio.php?status=success');
  exit;
}

require_once '../includes/headerPages.php';
require_once '../includes/confirmarExclusao.php';
require_once '../includes/footer.php';