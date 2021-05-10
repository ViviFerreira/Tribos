<section class="confirme">
  <h2 class="mt-3"><i class="bi bi-emoji-smile-upside-down"></i> Sair do Evento</h2>
  <form method="post">
    <div class="form-group">
      <p class="text-white">Você realmente deseja cancelar sua partipação no evento <strong><?=$obEvento->nmEvento?></strong>?</p>
    </div>
    <div class="form-group">
      <a href="eventosAbertos.php">
        <button type="button" class="btn btn-success btn-sm">
          <i class="bi bi-arrow-left"></i> Não
        </button>
      </a>
      <button type="submit" name="excluir" class="btn btn-danger btn-sm">
        <i class="bi bi-door-closed"></i> Sim
      </button>
    </div>
  </form>
</section>