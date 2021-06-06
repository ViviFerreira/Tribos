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

  //BUSCA
  $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
  
  //FILTRO STATUS
  $filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
  
  $filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';
  
  //CONDIÇÕES SQL
  $condicoes = [
    strlen($busca) ? 'nmEvento LIKE "%'.str_replace(' ','%',$busca).'%"' : null
    ,strlen($filtroStatus) ? 'flAtivo = "'.$filtroStatus.'"' : null
  ];

  //REMOVE POSIÇÕES VAZIAS
  $condicoes = array_filter($condicoes); 

  //CLÁUSULA WHERE 
  $where = implode(' AND ',$condicoes);

  $eventos = $obEvento->getEventos($where);
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
