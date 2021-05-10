<section class="confirme">
  <h2 class="mt-3"><i class="bi bi-emoji-smile-upside-down"></i> Sair da Tribo</h2>
  <form method="post">
    <div class="form-group">
      <p class="text-white">Você realmente deseja sair da tribo <strong><?=$obGrupo->nmGrupo?></strong>?</p>
    </div>
    <div class="form-group">
      <a href="inicio.php">
        <button type="button" class="btn btn-success btn-sm"><i class="bi bi-x-circle"></i> Cancelar</button>
      </a>
      <button type="submit" name="excluir" class="btn btn-danger btn-sm"><i class="bi bi-door-closed"></i> Sair</button>
    </div>
  </form>
</section>