<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Grupo;
  use \App\Entity\Evento;
  $obGrupo = new Grupo; 
  $obEvento = new Evento; 
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }
  $eventos = $obEvento->getEventos();
  ?>
<?php
  require_once '../includes/listEventoPublico.php';
  require_once '../includes/listEventoPrivado.php';
  require_once '../includes/footer.php';
?>