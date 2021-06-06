            <div class="col-md-4 gedf-main mt-3">
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2 tribo">
                                    <img class="rounded-circle" width="45" height="45" src="https://img.freepik.com/vetores-gratis/conceito-de-papel-de-parede-elegante-textura-branca_23-2148432202.jpg?size=626&ext=jpg" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><?=$evento->nmEvento?></div>
                                    <div class="h7 text-muted"> Por <?=$nmGrupoCriador?></div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link text-white" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Mais Opções</div>
                                        <?='<a href="../pages/detalhesEvento.php?id='.$evento->idEvento.'" class="dropdown-item"><i class="bi bi-eye"></i> Detalhes</a>'?>
                                        <?=$opcoesUsuarioAdmin?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bg-dark">
                      <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center gedf-card">
                          <span class="card-text">
                            <?=$evento->descEvento?>
                          </span>
                          <a href="participantesGrupo.php?id=<?=$grupo->idGrupo?>"><span class="badge badge-primary badge-pill"><i class="bi bi-person-lines-fill"></i> <?=$parts?></span></a>
                        </li>
                      </ul>
                    </div>
                    <div class="card-footer">
                      <?=$resultados?>
                      <?=$evento->flAtivo == 's' ? 
                      '<span class="h6 text-warning center"><i class="bi bi-emoji-smile"></i> Evento Ativo </span> ' :
                      '<span class="h6 text-muted center"><i class="bi bi-emoji-frown"></i> Evento Inativo </span> '
                      ?>
                    </div>
                </div>
            </div>