<?php
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\GruposUsuario;
  $obGrupoUserLogado = new GruposUsuario;
  $obUser = new Usuario; 
  $idUsuarioLogado = $_SESSION['idUsuario'];
  $opcoesUsuarioAdmin = '';
  $resultados = '';
  ?>
  <div class="wrapper">

  <!-- Filtros -->
  <section class="">
    <form method="get">
      <div class="row mx-auto">
        <div class="col-md-4 mt-2">
          <label><i class="bi bi-filter-right"></i> Buscar tribo</label>
          <input type="text" name="busca" class="form-control" value="<?=$busca?>" autocomplete="off" autofocus>
        </div>

        <div class="col-md-2 mt-2">
          <label><i class="bi bi-filter-right"></i> Status</label>
          <select name="filtroStatus" class="form-control">
            <option value="s" <?=$filtroStatus == 's'? 'selected' : ''?>>Ativa</option>
            <option value="n" <?=$filtroStatus == 'n'? 'selected' : ''?>>Inativa</option>
            <option value="">Todas</option>
          </select>
        </div>

        <div class="col-md-4 d-flex align-items-end mt-3">
          <button type="submit" class="btn btn-info"><i class="bi bi-filter"></i> Filtrar</button>
        </div>
      </div>
    </form>
  </section>

  <div class="container-fluid gedf-wrapper mt-3 mb-5">
      <div class="row">
  <?php
  foreach($grupos as $grupo){
    //Consultando usuario criador da tribo 
    $userCriador = $obUser->getUsuario($grupo->idUsuarioCriou);
    $nmUsuarioCriador = $userCriador->nmUsuario;

    //Consultando tribos do usuário logado 
    $grupoUserLogado = $obGrupoUserLogado->getGrupoUsuario($idUsuarioLogado, $grupo->idGrupo);

    //Consultando se tribos estão inativas
    $statusGrupo = $grupo->flAtivo;

    // Se o usuário logado foi quem criou a tribo, ele pode editar e participar              
    $opcoesUsuarioAdmin = $idUsuarioLogado == $grupo->idUsuarioCriou ? 
                        ' 
                        <a href="../pages/editarTribo.php?id='.$grupo->idGrupo.'" class="dropdown-item"><i class="bi bi-pencil-square"></i> Editar</a>
                        ' : null;

    // Se o usuario logado já participa da tribo aparece botão para sair, se não para participar (se a tribo não estiver inativa) 
    if(!empty($grupoUserLogado)){ 
      $resultados = ' <a href="../pages/sairTribo.php?id='.$grupo->idGrupo.'" class="btn btn-danger btn-sm"><i class="bi bi-door-closed"></i> Sair</a>';
    }elseif($statusGrupo == 's'){
      $resultados = '<a href="../pages/participarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-success btn-sm"><i class="bi bi-door-open"></i> Participar</a>';
    }else{ 
      $resultados ='<a href="#" class="btn btn-success btn-sm disabled" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-door-open"></i>Participar</a>';
    }

    // Se o usuário logado for quem criou a tribo, e ele já participa da tribo, pode incluir um novo evento 
    $opcoesUsuarioAdmin .= ($idUsuarioLogado == $grupo->idUsuarioCriou and !empty($grupoUserLogado)) ? 
                        ' 
                        <a href="../pages/cadastrarEvento.php?id='.$grupo->idGrupo.'" class="dropdown-item">
                        <i class="bi bi-calendar2-event"></i> Novo Evento
                        </a>
                        ' : 
                        null;

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
                                    <div class="h5 m-0"><?=$grupo->nmGrupo?></div>
                                    <div class="h7 text-muted"> Por <?=$nmUsuarioCriador?></div>
                                </div>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link text-white" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Mais Opções</div>
                                        <a class="dropdown-item" href="#"><i class="bi bi-people-fill"></i> Partipantes</a>
                                        <?=$opcoesUsuarioAdmin?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="card-text">
                          <?=$grupo->descGrupo?>
                        </span>
                    </div>
                    <div class="card-footer">
                      <?=$resultados?>
                    </div>
                </div>
            </div>
  <?php
  }
  ?>
    </div>
  </div>
  <section class="ml-3 mt-3 mb-3">
    <?=$paginacao ?? ''?>
  </section>
</div>
