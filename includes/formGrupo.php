<section class="container new-tribo">
    <form method="post">
        <h2 class="mt-3"><?=TITLE?></h2>
        <div class="mt-5 form-group">
            <label for="nmGrupo">Escolha um nome para sua tribo</label>
            <div class="input-group mt-3 line">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-emoji-smile"></i></span>
                <input type="text" class="form-control line" name="nome" id="nmGrupo" autofocus autocomplete="off" placeholder="Digite o nome" maxlength="45" required value="<?=$obGrupo->nmGrupo?>">
            </div>
        </div>
        <div class="form-group">
            <label for="nmGrupo">Decreva sua Tribo</label>
            <div class="input-group mt-3 line">
                <span class="input-group-text" id="basic-addon1"><i class="bi bi-list-nested"></i></span>
                <input type="text" class="form-control" name="desc" id="desc" autocomplete="off" placeholder="Digite a descrição" maxlength="200" value="<?=$obGrupo->descGrupo?>">
            </div>
        </div>
        <div class="form-group line">
            <div>
                <label>Status</label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-control">
                    <input type="radio" name="status" value="s" checked> Ativa
                </label>
            </div>

            <div class="form-check form-check-inline">
                <label class="form-control">
                    <input type="radio" name="status" value="n" <?=$obGrupo->flAtivo == 'n' ? 'checked' : ''?> id="tipo"> Inativa
                </label>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-sm mt-3">Enviar</button>
        </div>
    </form>
</section>
