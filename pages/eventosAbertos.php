<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Grupo;
  use \App\Entity\Evento;
  use \App\Entity\Usuario;
  $obUser = new Usuario;
  $obGrupo = new Grupo; 
  $obEvento = new Evento; 
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }else{
    $userLogado = $obUser->getUsuario($_SESSION['idUsuario']);
    $nmUsuario = $userLogado->nmUsuario;
  }
  $eventos = $obEvento->getEventos();
  ?>
  <section class="dash">
    <div class="jumbotron dash">
      <h3 class="display-4 wellcome">Você chegou a aba de eventos, <?=$nmUsuario?>!</h3>
      <p class="lead text-dark">Abaixo, disponibizamos eventos para você participar, fique a vontade para escolher!</p>
      <hr class="my-4">
      <a href="inicio.php"><button class="btn btn-primary btn-sm" href="#"><i class="bi bi-arrow-left"></i> Voltar</button>
    </a>
    </div>
  </section>
  <?php
    require_once '../includes/listEventoPublico.php';
    require_once '../includes/listEventoPrivado.php';
    require_once '../includes/footer.php';
  ?>
