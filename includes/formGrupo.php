<section class="container">
    <form method="post">
        <h2 class="mt-3"><?=TITLE?></h2>
        <div class="mt-5 form-group">
            <label for="nmGrupo">Escolha um nome para sua tribo</label>
            <input type="text" class="form-control" name="nome" id="nmGrupo" autofocus autocomplete="off" placeholder="Digite o nome" maxlength="45" required value="<?=$obGrupo->nmGrupo?>">
        </div>
        <div class="form-group">
            <label for="nmGrupo">Decreva sua Tribo</label>
            <input class="form-control" name="desc" id="desc"  placeholder="Digite a descrição" maxlength="200" value="<?=$obGrupo->descGrupo?>">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</section>
