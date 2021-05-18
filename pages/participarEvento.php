<?php
require_once '../vendor/autoload.php';
use App\Entity\Evento;
use \App\Entity\EventosUsuario;
$obEventoUser = new EventosUsuario;
$obEvento = new Evento;
session_start();
if(!isset($_SESSION['idUsuario'])){
  header("Location: formLogin.php");
  exit;
}else{
    $idUsuarioLogado = $_SESSION['idUsuario'];
}
//Verificar se clicou no botão 
if(isset($_GET['id'])){
    //Consulta evento a participar
    $obEventoUser->idEvento = addslashes($_GET['id']);
    $obEventoSetado = $obEvento->getEvento( $obEventoUser->idEvento);
    $qtPartsEventoSetado = $obEventoSetado->qtPartsEvento;
    $obEventoUser->idUsuario = addslashes($idUsuarioLogado);
    //Verificar se o evento já está lotado
    $usuariosEventoSetado = $obEventoUser->getEventosUsuario('idEvento = '.$obEventoUser->idEvento);
    $parts = count($usuariosEventoSetado); 
  
    if($parts < $qtPartsEventoSetado):
        //Verificar se está preenchido
        if($obEventoUser->participar())
        {
            header('location: eventosAbertos.php?status=success');
            exit;
        }else{
            header('location: inicioAbertos.php?status=error');
            exit;
        }
    else:
        header('location: eventosAbertos.php?status=error');
        exit;
    endif;
}   
require_once '../includes/headerPages.php';
require_once '../includes/footer.php';