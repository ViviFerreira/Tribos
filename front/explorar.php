<?php
  require_once( 'headPadrao.php' );
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: login.php");
    exit;
  }
?>
<body>
  <div class="explorar">
    <h3 class="title-explorar">Seja bem vindo à Tribos</h3>
    <a href="sair.php">Sair</a>
  </div>
</body>
</html>