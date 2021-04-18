<?php
   require_once '../includes/head.php';
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }
?>
  <div class="explorar">
    <h3 class="title-explorar">Seja bem vindo à Tribos</h3>

    <a href="formTribo.php">Tribos</a>






    <a href="sair.php">Sair</a>
  </div>
<?php
   require_once '../includes/footer.php';
?>