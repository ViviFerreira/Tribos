<?php
  require_once( 'headPadrao.php' );
  require_once( '../back/processLog.php' );
?>
<body>
<section class="form-section">
  <form method="post">
    <div class="form-wrapper">
    <span class="title-form">Login</span>
        <div class="input-block">
          <input type="email" class="form-control" name="email" id="inputEmail" autofocus autocomplete="off" placeholder="Digite seu email" maxlength="45" required>
        </div>
    </div>
    <div class="form-wrapper">
        <div class="input-block">
          <input type="password" class="form-control" name="senha" id="inputSenha" placeholder="Digite sua senha" maxlength="16" required>
        </div>
    </div>
    <input type="submit" value="Acessar" class="btn btn-login">
    <div class="link-log">
      <span>Ainda não é inscrito? <a href="cadastro.php" id="link-log">Cadastre-se</a></span>
    </div>
  </form>
</section>
</body>
</html>  