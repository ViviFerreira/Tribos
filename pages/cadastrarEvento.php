<?php
require_once '../vendor/autoload.php';
define('TITLE','Cadastrar Evento');
use \App\Entity\Evento;
$obEvento = new Evento;
session_start();
if(!isset($_SESSION['idUsuario'])){
  header("Location: formLogin.php");
  exit;
}else{
    $idUsuarioLogado = $_SESSION['idUsuario'];
}
//Verificar se clicou no botão 
if(isset($_POST['nome'])){
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
    $obEvento->idGrupoCriou = addslashes($_GET['id']);

    //Verificar se está preenchido
    if(!empty($obEvento->nmEvento) && !empty($obEvento->descEvento) && !empty($obEvento->dtEvento) && !empty($obEvento->hrEvento) && !empty($obEvento->qtPartsEvento) && !empty($obEvento->localEvento)  && !empty($obEvento->numLocalEvento) && !empty($obEvento->idGrupoCriou))
    {
        if($obEvento->cadastrar())
        {
            header('location: eventosAbertos.php?status=success');
            exit;
        }else{
            header('location: inicio.php?status=error');
            exit;
        }
    }else
    {
        echo "<script>alert('Preencha todos os campos!')</script>";
    }
}
require_once '../includes/headerPages.php';
require_once '../includes/formEvento.php';
require_once '../includes/footer.php';