<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\Grupo;
  $obUser = new Usuario; 
  $obGrupo = new Grupo; 
  session_start();
  if(!isset($_SESSION["idUsuario"])){
      header("Location: formLogin.php");
      exit;
    }else{
      $userLogado = $obUser->getUsuario($_SESSION['idUsuario']);
      $nmUsuario = $userLogado->nmUsuario;
    }
  $grupos = $obGrupo->getGrupos();
  ?>
  <section class="dash">
    <div class="jumbotron dash">
      <h3 class="display-4 wellcome">Seja Bem-Vindo(a) à Tribos, <?=$nmUsuario?>!</h3>
      <p class="lead text-dark">A Tribos é uma plataforma criada para contribuir no âmbito social, nosso foco é a união!</p>
      <hr class="my-4">
      <a href="cadastrarTribo.php"><button class="btn btn-primary btn-sm" href="#">Criar uma tribo</button>
    </a>
    </div>
  </section>
  <section class="tribos">
    <h4 class="title-tribos"><i class="bi bi-people"></i> Tribos</h4>
      <?php
        require_once '../includes/listGrupo.php';
      ?>
  </section>
  <?php
    require_once '../includes/footer.php';
  ?>
