<?php
  require_once( 'headPadrao.php' );
  require_once( 'processLog.php' );
?>
<body>
<div class="container">
  <form method="post" class="mt-5">
    <div class="row">
        <div class="col-md-6">
          <label for="inputEmail">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail" autofocus autocomplete="off" placeholder="Digite seu email" maxlength="45" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <label for="inputSenha">Senha</label>
          <input type="password" class="form-control" name="senha" id="inputSenha" placeholder="Digite sua senha" maxlength="16" required>
        </div>
    </div>
    <input type="submit" value="Acessar" class="btn btn-primary">
    <a href="cadastro.php">Ainda não é inscrito? <strong>Cadastre-se</strong></a>
  </form>
</div>
</body>
</html>  