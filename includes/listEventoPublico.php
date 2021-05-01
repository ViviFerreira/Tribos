<?php
  require_once '../vendor/autoload.php';
  use \App\Entity\Grupo;
  use \App\Entity\Evento;
  use \App\Entity\GruposUsuario;
  use \App\Entity\EventosUsuario;
  $obGrupoUserLogado = new GruposUsuario;
  $obEventoUserLogado = new EventosUsuario;
  $obGrupo = new Grupo; 
  $obEvento = new Evento;
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
                          ' 
                          <a href="../pages/editarEvento.php?id='.$evento->idEvento.'" class="btn btn-outline-primary">Editar</a>
                          ' : null;
      // Se o usuario logado já participa do evento aparece botão para sair, se não para participar               
      $resultados .= !empty($eventoUserLogado) ?
                        '  
                        <a href="../pages/sairEvento.php?id='.$evento->idEvento.'" class="btn btn-outline-danger">
                        Sair
                        </a>
                        ' : 
                        ' 
                        <a href="../pages/participarEvento.php?id='.$evento->idEvento.'" class="btn btn-outline-success">Participar
                        </a>
                        ';
?>
<div class="card" style="width: 18rem; display:inline-block">
  <div class="card-header">
    Criado por <?=$nmGrupoCriador?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$evento->nmEvento?></h5>
    <p class="card-text"><?=$evento->descEvento?></p>
    <div class="btn-group" role="group" aria-label="Basic example">
      <?=$resultados?>
    </div>
  </div>
</div>
<?php
    }
 }
  echo empty($resultados) ? 'Nenhum evento aberto no momento ;(' : '';
?>


