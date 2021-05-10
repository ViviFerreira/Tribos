<?php

require_once '../vendor/autoload.php';

define('TITLE','Editar Evento');

use \App\Entity\Evento;
$obEvento = new Evento;

//VALIDAÇÃO DO ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
  header('location: eventosAbertos.php?status=error');
  exit;
}

//CONSULTA O EVENTO
$obEvento = $obEvento->getEvento($_GET['id']);

//VALIDAÇÃO DO GRUPO
if(!$obEvento instanceof Evento){
  header('location: eventosAbertos.php?status=error');
  exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['nome'],$_POST['desc']))
{
    //DEFINIR A DATA
    date_default_timezone_set('America/Sao_Paulo');
    $obEvento->dtCriado = date('Y-m-d H:i:s');
    $obEvento->dtEvento = addslashes($_POST['data']);
    $obEvento->hrEvento = addslashes($_POST['hora']);
    $obEvento->nmEvento = addslashes($_POST['nome']);
    $obEvento->descEvento = addslashes($_POST['desc']);
    $obEvento->qtPartsEvento = addslashes($_POST['parts']);
    $obEvento->flEventoPrivado = addslashes($_POST['tipo']);
    $obEvento->localEvento = addslashes($_POST['local']);
    $obEvento->numLocalEvento = addslashes($_POST['num']);

    //Verificar se está preenchido
    if(!empty($obEvento->nmEvento) && !empty($obEvento->descEvento) && !empty($obEvento->dtEvento) && !empty($obEvento->hrEvento) && !empty($obEvento->qtPartsEvento) && !empty($obEvento->localEvento)  && !empty($obEvento->numLocalEvento))
    {
        $obEvento->atualizar();
        header('location: eventosAbertos.php?status=success');
        exit;
    }else{
    ?>
        <script>
            alert("Preencha todos os campos!");
        </script>
    <?php
    }
}

require_once '../includes/headerPages.php';
require_once '../includes/formEvento.php';
require_once '../includes/footer.php';