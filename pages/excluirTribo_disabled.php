<?php

require_once '../vendor/autoload.php';

use \App\Entity\Grupo;
$obGrupo = new Grupo;
//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
  header('location: inicio.php?status=error');
  exit;
}else{
  $obGrupo->idGrupo = addslashes($_GET['id']);
}

//CONSULTA O GRUPO
$obGrupo->getGrupo($_GET['id']);

//VALIDAÇÃO DO GRUPO
if(!$obGrupo instanceof Grupo){
  header('location: inicio.php?status=error');
  exit;
}
//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){
  if($obGrupo->excluir()){ ;
    ?>
    <script>
      alert("Excluída com sucesso!");
    </script>
  <?php
  }else{
  ?>
    <script>
      alert("Essa tribo não pode ser excluída pois existem usuários!");
    </script>
  <?php
    exit;
  }
}

require_once '../includes/headerPages.php';
require_once '../includes/confirmarExclusao.php';
require_once '../includes/footer.php';