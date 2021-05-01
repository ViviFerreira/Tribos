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

  <h4 class="title-tribos"><i class="bi bi-calendar2-event"></i> Eventos Abertos</h2>
<?php
  require_once '../includes/listEventoPublico.php';
?>
  <h4 class="title-tribos"><i class="bi bi-calendar2-event"></i> Eventos das minhas Tribos </h2>
<?php
  require_once '../includes/listEventoPrivado.php';
?>
<?php
 require_once '../includes/footer.php';
?>