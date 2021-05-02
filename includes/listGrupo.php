<?php
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\GruposUsuario;
  $obGrupoUserLogado = new GruposUsuario;
  $obUser = new Usuario; 
  $idUsuarioLogado = $_SESSION['idUsuario'];
  $mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success':
        $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
        break;

      case 'error':
        $mensagem = '<div class="alert alert-danger">Ação não executada!</div>';
        break;
    }
  }
  $resultados = '';
  ?>
  <div class="wrapper">
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
                        <a href="../pages/editarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-outline-primary btn-sm">Editar</a>
                        ' : null;

    // Se o usuario logado já participa da tribo aparece botão para sair, se não para participar               
    $resultados .= !empty($grupoUserLogado) ?
                      '  
                      <a href="../pages/sairTribo.php?id='.$grupo->idGrupo.'" class="btn btn-outline-danger btn-sm">
                      Sair
                      </a>
                      ' : 
                      ' 
                      <a href="../pages/participarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-outline-success btn-sm">Participar
                      </a>
                      ';
    // Se o usuário logado for quem criou a tribo, e ele já participa da tribo, pode incluir um novo evento 
    $resultados .= ($idUsuarioLogado == $grupo->idUsuarioCriou and !empty($grupoUserLogado)) ? 
                        ' 
                        <a href="../pages/cadastrarEvento.php?id='.$grupo->idGrupo.'" class="btn btn-outline-info btn-sm">
                        Novo Evento
                        </a>
                        ' : 
                        null;
   
  $resultados = strlen($resultados) ? $resultados : 'Nenhuma tribo encontrada';
?>
	<div class="cards_wrap">
		<div class="card_item">
			<div class="card_inner">
				<img src="../assets/img/imgCards.jpg">
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
</div>
<?=$mensagem?>