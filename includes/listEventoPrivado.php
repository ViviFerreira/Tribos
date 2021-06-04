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
              <div class="container mt-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-square-fill"></i> Pronto! Ação realizada com sucesso
                </div>
              </div>
                  ';
        break;
      case 'error':
        $mensagem = '
              <div class="container mt-2">
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
  
  <div class="eventos"> 
      <h4 class="title-tribos"><i class="bi bi-calendar2-event"></i> Eventos das minhas tribos</h4>
      <div class="container-fluid gedf-wrapper mb-3">
        <div class="row">
      <?php
      foreach($eventos as $evento){
        //Consultando nome e id do grupo criador do evento 
        $grupoCriador = $obGrupo->getGrupo($evento->idGrupoCriou);
        $idGrupoCriador = $grupoCriador->idGrupo;
        $nmGrupoCriador = $grupoCriador->nmGrupo;

        $idUserCriador = $grupoCriador->idUsuarioCriou;

        // Consultando se usuário participa da tribo que criou o evento 
        $grupoUserLogado = $obGrupoUserLogado->getGrupoUsuario($idUsuarioLogado, $evento->idGrupoCriou);

        // Apenas entra no resultado se o evento for privado e o usuário fizer parte da tribo que criou o evento
        if($evento->flEventoPrivado == 's' && !empty($grupoUserLogado)){
          // Consultando se o usuario já participa do evento 
          $eventoUserLogado = $obEventoUserLogado->getEventoUsuario($evento->idEvento, $idUsuarioLogado);

          // Se o usuário logado foi quem criou a tribo do evento, ele pode editar           
          $opcoesUsuarioAdmin = $idUsuarioLogado == $idUserCriador ? 
                            ' 
                            <a href="../pages/editarEvento.php?id='.$evento->idEvento.'" class="dropdown-item"><i class="bi bi-pencil-square"></i> Editar</a>
                            ' 
                                                          : null;
          //Verifica se o evento está lotado 
          $qtPartsEventoSetado = $evento->qtPartsEvento; //qt limite
          $usuariosEventoSetado = $obUsuariosEvento->getEventosUsuario('idEvento = '.$evento->idEvento); //qt atual
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
    //GETS
    unset($_GET['status']);
    unset($_GET['pagina']);
    $gets = http_build_query($_GET);

    //PAGINAÇÃO                   
    $paginacao =  '';
    $paginas = $obPagination->getPages();
    foreach ($paginas as $key => $pagina) {
      $class = $pagina['atual'] ? 'btn-primary' : 'btn-dark';
      $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.'">
                        <button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button>
                    </a>';
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
                      <?=$evento->flAtivo == 's' ? 
                      '<span class="h6 text-warning center"><i class="bi bi-emoji-smile"></i> Evento Ativo </span> ' :
                      '<span class="h6 text-muted center"><i class="bi bi-emoji-frown"></i> Evento Inativo </span> '
                      ?>
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
      // Consultando se o usuário participa de alguma tribo 
      $obGruposUserLogado = $obGrupoUserLogado->getGruposUsuario('idUsuario = '.$idUsuarioLogado);
      echo empty($obGruposUserLogado) ? '
      <div class="container">
        <div class="alert alert-warning mt-5 mb-5" role="alert">
        <i class="bi bi-emoji-smile-upside-down-fill"></i> Você não faz parte de nenhuma tribo!
        </div>
      </div>'                         : '';
      echo (empty(!$obGruposUserLogado) and empty($resultados)) ? '
      <div class="container">
        <div class="alert alert-warning mt-5 mb-5" role="alert">
        <i class="bi bi-emoji-smile-upside-down-fill"></i> Nenhum evento das tribos no momento!
        </div> 
      </div>' 
                                                                : null; 
    ?>
  <section class="ml-3 mt-3 mb-3">
    <?=$paginacao ?? ''?>
  </section>