<section class="container new-evento">
    <form method="post">
        <h2 class="mt-3"><?=TITLE?></h2>
        <div class="mt-4 row">
            <div class="col-md-8"> 
                <label for="nome">Nome do Evento</label>
                <input type="text" class="form-control" name="nome" id="nome" autofocus autocomplete="off" maxlength="45" required value="<?=$obEvento->nmEvento?>">
            </div>
        </div>
        <div class="mt-4 row">
            <div class="col-md-8"> 
                <label for="desc">Descrição do Evento</label>
                <input type="text" class="form-control" name="desc" id="desc" autocomplete="off" maxlength="200" required value="<?=$obEvento->descEvento?>">
            </div>
        </div>
        <div class="mt-4 row">
            <div class="col-md-4">
                <label for="data">Data do Evento</label>
                <input type="date" class="form-control" name="data" id="data"  autocomplete="off" required
                    value="<?=$obEvento->dtEvento?>">
            </div>
            <div class="mt-4 col-md-4">
                <label for="hora">Hora do Evento</label>
                <input type="time" class="form-control" name="hora" id="hora"  autocomplete="off" required value="<?=$obEvento->hrEvento?>">
            </div>
        </div>
        <div class="mt-4 row">
            <div class="col-md-4">
                    <label for="parts">Quantidade de Participantes</label>
                    <input type="number" class="form-control" name="parts" id="parts" autocomplete="off" required value="<?=$obEvento->qtPartsEvento?>">
                </div>
            </div>
        </div>
        <div>
            <div class="mt-4 form-group line">
                <div>
                    <label>Visibilidade</label>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="tipo" value="s" checked> Somente tribo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="tipo" value="n" <?=$obEvento->flEventoPrivado == 'n' ? 'checked' : ''?> id="tipo"> Público
                    </label>
                </div>
            </div>
            <div class="mt-4 row">
                <div class="col-md-6">
                    <label for="tipo"> Local do Evento </label>
                    <input type="local" class="form-control" name="local" id="local" autocomplete="off" maxlength="200"
                    required value="<?=$obEvento->localEvento?>">
                </div>
                <div class="col-md-2">
                    <label for="tipo"> Nº </label>
                    <input type="num" class="form-control" name="num" id="num" autocomplete="off" required value="<?=$obEvento->numLocalEvento?>">
                </div>
            </div>
            <div class="mt-4 form-group">
                <button type="submit" class="btn btn-success btn-sm">Enviar</button>
            </div>
    </form>
</section>