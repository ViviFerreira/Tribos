<?php
  require_once( 'headPadrao.php' );
?>
<body>
  <form method="get" class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <label for="inputNome">Nome</label>
          <input type="email" class="form-control" id="inputImail" name="nome"
            placeholder="Digite seu email">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="inputEmail">E-mail</label>
          <input type="password" class="form-control" id="inputEmail" name="email" placeholder="Digite sua senha">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label for="inputSenha">Senha</label>
          <input type="password" class="form-control" id="inputSenha" name="senha" placeholder="Digite sua senha">
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </form>
</body>
</html>