<?php
require_once '../vendor/autoload.php';
require_once '../includes/headerPages.php';
use \App\Entity\EventosUsuario;
use \App\Entity\Evento;
$obEventoUser = new EventosUsuario;
$obEvento = new Evento;
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
    //CONSULTA O EVENTO
    $obEvento = $obEvento->getEvento($_GET['id']);
    $obEventoUser->idEvento = addslashes($_GET['id']);
    $obEventoUser->idUsuario = addslashes($idUsuarioLogado);
    //VALIDAÇÃO DO POST
    if(isset($_POST['excluir'])){
        //Verificar se está preenchido
        if($obEventoUser->sair($obEventoUser->idEvento, $obEventoUser->idUsuario))
        {
            header('location: eventosAbertos.php?status=success');
            exit;
        }else{
            header('location: eventosAbertos.php?status=error');
            exit;
            }
        }
    }
    require_once '../includes/confirmarSairEvento.php';
    require_once '../includes/footer.php';
?>