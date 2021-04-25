<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\Grupo;
  $obUser = new Usuario; 
  $obGrupo = new Grupo; 
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }else{
    $obUser = new Usuario;
    $userLogado = $obUser->getUsuario($_SESSION['idUsuario']);
    $nmUsuario = $userLogado->nmUsuario;
  }
 
  $grupos = $obGrupo->getGrupos();
  ?>
<section class="dash">
  <div class="jumbotron">
    <h3 class="display-4 wellcome">Seja Bem Vindo(a) à Tribos, <?=$nmUsuario?>!</h3>
    <p class="lead">A Tribos é uma plataforma criada para contribuir no âmbito social </p>
    <hr class="my-4">
    <p>#Partir</p>
    <a href="cadastrarTribo.php"><button class="btn btn-primary" href="#">Criar uma tribo</button></a>
  </div>
  <a href="sair.php">Sair</a>
</section>
<?php
  require_once '../includes/listGrupo.php';
  require_once '../includes/footer.php';
?>