<?php
   require_once '../includes/headPages.php';
   require_once '../includes/explorar.php';
?>
<section class="dash">
  <div class="jumbotron">
    <h3 class="display-4 wellcome">Seja Bem Vindo(a) à Tribos, <?=$nmUsuario?>!</h3>
    <p class="lead">A Tribos é uma plataforma criada para contribuir no âmbito social </p>
    <hr class="my-4">
    <p>#Partir</p>
    <a href="formTribo.php"><button class="btn btn-primary" href="#">Criar uma tribo</button></a>
  </div>
  <a href="sair.php">Sair</a>
</section>
<?php
   require_once '../includes/footer.php';
?>