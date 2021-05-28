<?php
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\GruposUsuario;
  $obGrupoUserLogado = new GruposUsuario;
  $obUser = new Usuario; 
  $idUsuarioLogado = $_SESSION['idUsuario'];
  $resultados = '';
  ?>
  <div class="wrapper">

  <!-- Filtros -->
  <section class="ml-4">
    <form method="get">
      <div class="row my-4">

        <div class="col">
          <label><i class="bi bi-filter-right"></i> Buscar tribo</label>
          <input type="text" name="busca" class="form-control" value="<?=$busca?>" autocomplete="off" autofocus>
        </div>

        <div class="col">
          <label><i class="bi bi-filter-right"></i> Status</label>
          <select name="filtroStatus" class="form-control">
            <option value="">Ativa/Inativa</option>
            <option value="s" <?=$filtroStatus == 's'? 'selected' : ''?>>Ativa</option>
            <option value="n" <?=$filtroStatus == 'n'? 'selected' : ''?>>Inativa</option>
          </select>
        </div>

        <div class="col d-flex align-items-end ml-n3">
          <button type="submit" class="btn btn-primary"><i class="bi bi-filter"></i> Filtrar</button>
        </div>
      </div>
    </form>
  </section>

  <?php
  foreach($grupos as $grupo){
    //Consultando usuario criador da tribo 
    $userCriador = $obUser->getUsuario($grupo->idUsuarioCriou);
    $nmUsuarioCriador = $userCriador->nmUsuario;

    //Consultando tribos do usuário logado 
    $grupoUserLogado = $obGrupoUserLogado->getGrupoUsuario($idUsuarioLogado, $grupo->idGrupo);
    // Se o usuário logado foi quem criou a tribo, ele pode editar e participar              
    $resultados = $idUsuarioLogado == $grupo->idUsuarioCriou ? 
                        ' 
                        <a href="../pages/editarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>
                        ' : null;

    // Se o usuario logado já participa da tribo aparece botão para sair, se não para participar               
    $resultados .= !empty($grupoUserLogado) ?
                      '  
                      <a href="../pages/sairTribo.php?id='.$grupo->idGrupo.'" class="btn btn-danger btn-sm">
                      <i class="bi bi-door-closed"></i> Sair
                      </a>
                      ' : 
                      ' 
                      <a href="../pages/participarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-success btn-sm"><i class="bi bi-door-open"></i> Participar
                      </a>
                      ';
    // Se o usuário logado for quem criou a tribo, e ele já participa da tribo, pode incluir um novo evento 
    $resultados .= ($idUsuarioLogado == $grupo->idUsuarioCriou and !empty($grupoUserLogado)) ? 
                        ' 
                        <a href="../pages/cadastrarEvento.php?id='.$grupo->idGrupo.'" class="btn btn-info btn-sm">
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
	<div class="cards_wrap">
		<div class="card_item">
			<div class="card_inner">
				<img src="../assets/img/imgCards.png">
				<div class="role_name"><?=$grupo->nmGrupo?></div>
				<div class="real_name">Criada por <?=$nmUsuarioCriador?></div>
				<div class="film"><?=$grupo->descGrupo?></div>
        <div class="buttons">
          <?=$resultados?>
        </div>
			</div>
		</div>
	</div>
  <?php
  }
  ?>
  <section class="ml-3">
    <?=$paginacao ?? ''?>
  </section>
</div>
