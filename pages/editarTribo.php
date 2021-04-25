<?php

require_once '../vendor/autoload.php';

define('TITLE','Editar Tribo');

use \App\Entity\Grupo;
$obGrupo = new Grupo;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
  header('location: inicio.php?status=error');
  exit;
}

//CONSULTA O GRUPO
$obGrupo = $obGrupo->getGrupo($_GET['id']);

//VALIDAÇÃO DO GRUPO
if(!$obGrupo instanceof Grupo){
  header('location: inicio.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['nome'],$_POST['desc']))
{
    $obGrupo->nmGrupo = addslashes($_POST['nome']);
    $obGrupo->descGrupo = addslashes($_POST['desc']);
    if(!empty($obGrupo->nmGrupo) && !empty($obGrupo->descGrupo))
    {
        $obGrupo->atualizar();
        header('location: inicio.php?status=success');
        exit;
    }else{
    ?>
        <script>
            alert("Preencha todos os campos!");
        </script>
    <?php
    }
}

// require_once '../includes/headerPages.php';
require_once '../includes/formGrupo.php';
require_once '../includes/footer.php';