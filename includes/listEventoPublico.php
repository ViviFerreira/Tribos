<?php
  require_once '../vendor/autoload.php';
  use \App\Entity\Grupo;
  use \App\Entity\Evento;
  use \App\Entity\GruposUsuario;
  use \App\Entity\EventosUsuario;

  $obGrupoUserLogado = new GruposUsuario;
  $obEventoUserLogado = new EventosUsuario;
  $obUsuariosEvento = new EventosUsuario;
  $obGrupo = new Grupo; 
  $obEvento = new Evento;
  $idUsuarioLogado = $_SESSION['idUsuario'];
  $mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success': 
        $mensagem = ' 
              <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-square-fill"></i> Pronto! Ação realizada com sucesso
                </div>
              </div>
                  ';
        break;
      case 'error':
        $mensagem = '
              <div class="container">
                <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="bi bi-exclamation-triangle"></i> Ops! Erro ao executar ação
                </div>
              </div>
                    ';
        break;
    }
  }
  $resultados = '';
  $opcoesUsuarioAdmin = '';
  ?>
  <div class="eventos-publicos">
    <?=$mensagem?>
    <h4 class="title-tribos"><i class="bi bi-calendar2-event"></i> Eventos Abertos</h4>
    <div class="container-fluid gedf-wrapper">
        <div class="row">
    <?php
    foreach($eventos as $evento){
      //Consultando nome do grupo criador do evento 
      $grupoCriador = $obGrupo->getGrupo($evento->idGrupoCriou);
      $nmGrupoCriador = $grupoCriador->nmGrupo;
      $idUserCriador = $grupoCriador->idUsuarioCriou;

      // Apenas entra no resultado se o evento for não privado 
      if($evento->flEventoPrivado == 'n'){
      
        // Consultando se o usuario já participa do evento 
        $eventoUserLogado = $obEventoUserLogado->getEventoUsuario($evento->idEvento,$idUsuarioLogado);

        // Se o usuário logado foi quem criou a tribo do evento, ele pode editar           
        $opcoesUsuarioAdmin = $idUsuarioLogado == $idUserCriador ? 
                            ' <a href="../pages/editarEvento.php?id='.$evento->idEvento.'" class="dropdown-item"><i class="bi bi-pencil-square"></i> Editar</a>
                            ' 
                            : null;
               
        //Verifica se o evento está lotado 
        $qtPartsEventoSetado = $evento->qtPartsEvento; //limite
        $usuariosEventoSetado = $obUsuariosEvento->getEventosUsuario('idEvento = '.$evento->idEvento); //Atual
        $parts = count($usuariosEventoSetado);   
        // Se o usuario logado já participa do evento aparece botão para sair, se não para participar (se o evento não estiver lotado) 
        if(!empty($eventoUserLogado)){ 
          $resultados = ' <a href="../pages/sairEvento.php?id='.$evento->idEvento.'" class="btn btn-danger btn-sm">
                            <i class="bi bi-door-closed"></i> Sair
                          </a>';
        }elseif($parts < $qtPartsEventoSetado){
          $resultados = ' <a href="../pages/participarEvento.php?id='.$evento->idEvento.'" class="btn btn-success btn-sm"><i class="bi bi-door-open"></i> 
                              Participar
                            </a>';
        }else{ 
          $resultados ='<a href="#" class="btn btn-success btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">Participar</a>';
        }

  ?> 
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
                    <div class="card-body">
                        <span class="card-text">
                          <?=$evento->descEvento?>
                        </span>
                    </div>
                    <div class="card-footer">
                      <?=$resultados?>
                    </div>
                </div>
            </div>
  <?php
      }
  }
  ?>
    </div>
  </div>
  <?php
    echo empty($resultados) ? '
    <div class="container">
      <div class="alert alert-warning mt-5" role="alert">
        <i class="bi bi-emoji-smile-upside-down-fill"></i> 
        Nenhum evento aberto no momento!
      </div>
    </div>' : '';
  ?>
</div>

