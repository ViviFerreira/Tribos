<section class="container">
    <form method="post">
        <h2 class="mt-3"><?=TITLE?></h2>
        <div class="mt-5 form-group">
            <label for="nome">Nome do Evento</label>
            <input type="text" class="form-control" name="nome" id="nome" autofocus autocomplete="off" maxlength="45"
                required value="<?=$obEvento->nmEvento?>">
        </div>
        <div class="mt-5 form-group">
            <label for="desc">Descrição do Evento</label>
            <input type="text" class="form-control" name="desc" id="desc" autocomplete="off" maxlength="200" required
                value="<?=$obEvento->descEvento?>">
        </div>
        <div class="mt-5 form-group">
            <label for="data">Data do Evento</label>
            <input type="date" class="form-control" name="data" id="data"  autocomplete="off" required
                value="<?=$obEvento->dtEvento?>">
        </div>
        <div class="mt-5 form-group">
            <label for="hora">Hora do Evento</label>
            <input type="time" class="form-control" name="hora" id="hora"  autocomplete="off" required
                value="<?=$obEvento->hrEvento?>">
        </div>
        <div class="mt-5 form-group">
            <label for="parts">Quantidade de Participantes</label>
            <input type="number" class="form-control" name="parts" id="parts" autocomplete="off" required value="<?=$obEvento->qtPartsEvento?>">
        </div>
        <div>
            <div class="mt-5 form-group">
                <label>Tipo de Evento</label>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="tipo" value="s" checked> Restrito à tribo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="tipo" value="n" <?=$obEvento->flEventoPrivado == 'n' ? 'checked' : ''?> id="tipo"> Aberto ao público
                    </label>
                </div>
            </div>
            <div class="mt-5 form-group">
                <label for="tipo"> Local do Evento </label>
                <input type="local" class="form-control" name="local" id="local" autocomplete="off" maxlength="200"
                required value="<?=$obEvento->localEvento?>">
                    
            </div>
            <div class="mt-5 form-group">
                <label for="tipo"> Nº </label>
                <input type="num" class="form-control mt-2" name="num" id="num" autocomplete="off" required value="<?=$obEvento->numLocalEvento?>">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
    </form>
</section>