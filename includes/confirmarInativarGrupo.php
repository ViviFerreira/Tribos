<section class="confirme">
  <h2 class="mt-3"><i class="bi bi-emoji-smile-upside-down"></i> Inativar Tribo</h2>
  <form method="post">
    <div class="form-group">
      <p class="text-white">Você realmente deseja inativar a tribo <strong><?=$obGrupo->nmGrupo?></strong>?</p>
    </div>
    <div class="form-group">
      <a href="inicio.php">
        <button type="button" class="btn btn-success btn-sm"><i class="bi bi-x-circle"></i> Cancelar</button>
      </a>
      <button type="submit" name="inativar" class="btn btn-danger btn-sm"><i class="bi bi-door-closed"></i> Inativar</button>
    </div>
  </form>
</section>