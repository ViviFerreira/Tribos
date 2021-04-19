<?php
  require_once '../includes/head.php';
  require_once '../includes/cadastro.php';
?>
<section class="form-section">
  <form method="post" class="form-user">
      <div class="form-wrapper">
      <span class="title-form">Cadastro</span>
        <div class="input-block">
          <input type="text" class="form-control" id="inputImail" name="nome"
            placeholder="Digite seu nome" autofocus autocomplete="off" maxlength="30" required>
        </div>
      </div>
      <div class="form-wrapper">
        <div class="input-block">
          <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Digite seu email" autocomplete="off" maxlength="45" required>
        </div>
      </div>
      <div class="form-wrapper">
        <div class="input-block">
          <input type="password" class="form-control" id="inputSenha" name="senha" placeholder="Digite sua senha" autocomplete="off" maxlength="16" required>
        </div>
      </div>
        <div class="form-wrapper">
          <div class="input-block">
            <input type="password" class="form-control" id="inputSenhaConfirme" name="senhaConf" placeholder="Confirme sua senha" autocomplete="off" maxlength="16" required>
          </div>
        </div>
        <input type="submit" value="Cadastrar" class="btn btn-login">
    </form>
</section>
<?php
   require_once '../includes/footer.php';
?>