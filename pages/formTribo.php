<?php
   require_once '../includes/head.php';
  require_once '../includes/grupo.php';
?>
    <section class="novaTribo">
        <form method="post">
        <label for="nTribo">Escolha um nome para sua tribo</label>
        <input type="text" name="nTribo" id="nTribo" autofocus autocomplete="off" placeholder="Digite o nome" maxlength="45" required>
        <input type="text" name="dTribo" id="dTribo" autofocus autocomplete="off" placeholder="Adicionar uma descrição" maxlength="45">
        <input type="submit" value="Cadastrar">
        </form>
    </section>
<?php
   require_once '../includes/footer.php';
?>