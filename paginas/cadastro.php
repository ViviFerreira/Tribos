<?php
  require_once( 'headPadrao.php' );
  require_once( 'processCad.php' );
?>
<body>
<div class="container">
  <form method="post" class="mt-5">
      <div class="row">
        <div class="col-md-6">
          <label for="inputNome">Nome</label>
          <input type="text" class="form-control" id="inputImail" name="nome"
            placeholder="Digite seu nome" maxlength="30" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="inputEmail">E-mail</label>
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Digite seu email" maxlength="45" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="inputSenha">Senha</label>
          <input type="password" class="form-control" id="inputSenha" name="senha" placeholder="Digite sua senha" maxlength="16" required>
        </div>
      </div>
        <div class="row">
          <div class="col-md-6">
            <label for="inputSenhaConfirme">Confirme sua senha</label>
            <input type="password" class="form-control" id="inputSenhaConfirme" name="senhaConf" placeholder="Confirme sua senha" required>
          </div>
        </div>
        <input type="submit" value="Cadastrar" class="btn btn-primary">
    </form>
  </div>
</body>
</html>