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
  ?>
  <div class="eventos-publicos">
    <?=$mensagem?>
    <h4 class="title-tribos"><i class="bi bi-calendar2-event"></i> Eventos Abertos</h4>
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
        $resultados = $idUsuarioLogado == $idUserCriador ? 
                            ' <a href="../pages/editarEvento.php?id='.$evento->idEvento.'" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                            ' 
                            : null;
               
        //Verifica se o evento está lotado 
        $qtPartsEventoSetado = $evento->qtPartsEvento; //limite
        $usuariosEventoSetado = $obUsuariosEvento->getEventosUsuario('idEvento = '.$evento->idEvento); //Atual
        $parts = count($usuariosEventoSetado);   
        // Se o usuario logado já participa do evento aparece botão para sair, se não para participar (se o evento não estiver lotado) 
        if(!empty($eventoUserLogado)){ 
          $resultados .= ' <a href="../pages/sairEvento.php?id='.$evento->idEvento.'" class="btn btn-danger btn-sm">
                            <i class="bi bi-door-closed"></i> Sair
                          </a>';
        }elseif($parts < $qtPartsEventoSetado){
          $resultados .= ' <a href="../pages/participarEvento.php?id='.$evento->idEvento.'" class="btn btn-success btn-sm"><i class="bi bi-door-open"></i> 
                              Participar
                            </a>';
        }else{ 
          $resultados .='<a href="#" class="btn btn-success btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">Participar</a>';
        }

        $resultados .=    '
                          <a href="../pages/detalhesEvento.php?id='.$evento->idEvento.'" class="btn btn-info btn-sm"><i class="bi bi-three-dots-vertical"></i> Detalhes</a>
                          ';    
  ?> 
    <div class="cards_wrap">
        <div class="card_item">
          <div class="card_inner">
            <img src="../assets/img/imgCardsEvento.jpg">
            <div class="role_name"><?=$evento->nmEvento?></div>
            <div class="real_name">Criada por <?=$nmGrupoCriador?></div>
            <div class="film"><?=$evento->descEvento?></div>
            <div class="buttons">
              <?=$resultados?>
            </div>
          </div>
        </div>
    </div>
  <?php
      }
  }
    echo empty($resultados) ? '
    <div class="container">
      <div class="alert alert-warning mt-5" role="alert">
        <i class="bi bi-emoji-smile-upside-down-fill"></i> 
        Nenhum evento aberto no momento!
      </div>
    </div>' : '';
  ?>
</div>

