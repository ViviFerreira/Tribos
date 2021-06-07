<?php
  require_once '../includes/header.php';
  require_once '../includes/login.php';
?>
<main class="main-user">
  <section class="form-section">
    <form method="post" class="form-user">
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
        <span>Ainda não é inscrito? <a href="formUsuario.php" id="link-log">Cadastre-se</a></span>
      </div>
    </form>
  </section>
<main>
<?php
  require_once '../includes/footer.php';
?>