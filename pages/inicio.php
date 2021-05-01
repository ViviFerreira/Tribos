<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\Grupo;
  $obUser = new Usuario; 
  $obGrupo = new Grupo; 
  session_start();
  $userLogado = $obUser->getUsuario($_SESSION['idUsuario']);
  if(!isset($_SESSION['idUsuario']) or empty($userLogado)){
    header("Location: formLogin.php");
    exit;
    }else{
      $nmUsuario = $userLogado->nmUsuario;
    }
  $grupos = $obGrupo->getGrupos();
  ?>
  <section class="dash">
    <div class="jumbotron dash">
      <h3 class="display-4 wellcome text-dark">Seja Bem Vindo(a) à Tribos, <?=$nmUsuario?>!</h3>
      <p class="lead text-dark">A Tribos é uma plataforma criada para contribuir no âmbito social, nosso foco é a união!</p>
      <hr class="my-4">
      <a href="cadastrarTribo.php"><button class="btn btn-outline-primary btn-sm" href="#">Criar uma tribo</button>
    </a>
    </div>
  </section>
  <h4 class="title-tribos"><i class="bi bi-people"></i> Tribos Abertas</h2>
<?php
  require_once '../includes/listGrupo.php';
  require_once '../includes/footer.php';
?>