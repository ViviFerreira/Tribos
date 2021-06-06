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
              <div class="container mt-5">
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-square-fill"></i> Pronto! Ação realizada com sucesso
                </div>
              </div>
                  ';
        break;
      case 'error':
        $mensagem = '
              <div class="container mt-5">
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
  <!-- Filtros -->
  <section class="">
    <form method="get">
      <div class="row mx-auto">
        <div class="col-md-4 mt-2">
          <label><i class="bi bi-filter-right"></i> Buscar evento</label>
          <input type="text" name="busca" class="form-control" value="<?=$busca?>" autocomplete="off" autofocus>
        </div>

        <div class="col-md-2 mt-2">
          <label><i class="bi bi-filter-right"></i> Status</label>
          <select name="filtroStatus" class="form-control">
            <option value="s" <?=$filtroStatus == 's'? 'selected' : ''?>>Ativo</option>
            <option value="n" <?=$filtroStatus == 'n'? 'selected' : ''?>>Inativo</option>
            <option value="">Todos</option>
          </select>
        </div>

        <div class="col-md-4 d-flex align-items-end mt-3">
          <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i> Filtrar</button>
        </div>
      </div>
    </form>
  </section>

  <div class="eventos">
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
        $qtPartsEventoSetado = $evento->qtPartsEvento; // qt limite
        $usuariosEventoSetado = $obUsuariosEvento->getEventosUsuario('idEvento = '.$evento->idEvento); //Atual
        $parts = count($usuariosEventoSetado); //qt atual

        // Se o usuario logado já participa do evento aparece botão para sair, se não para participar (se o evento não estiver lotado) 
        if(!empty($eventoUserLogado)){ 
          $resultados = ' <a href="../pages/sairEvento.php?id='.$evento->idEvento.'" class="btn btn-danger btn-sm">
                            <i class="bi bi-door-closed"></i> Sair
                          </a>';
        }elseif($parts < $qtPartsEventoSetado && $evento->flAtivo == 's'){
          $resultados = ' <a href="../pages/participarEvento.php?id='.$evento->idEvento.'" class="btn btn-success btn-sm"><i class="bi bi-door-open"></i> 
                              Participar
                            </a>';
        }else{ 
          $resultados ='<a href="#" class="btn btn-success btn-sm disabled" tabindex="-1" role="button" aria-disabled="true">Participar</a>';
        }
        
        require 'cardsEventos.php';

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

