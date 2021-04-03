<?php
  require_once( 'headPadrao.php' );
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: login.php");
    exit;
  }
?>
<body>
    <h1>Seja bem vindo à Tribos</h1>
    <a href="sair.php">Sair</a>
</body>
</html>