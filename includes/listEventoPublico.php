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
  ?>
  <div class="eventos-publicos">
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
                          ' 
                          <a href="../pages/editarEvento.php?id='.$evento->idEvento.'" class="btn btn-primary btn-sm">Editar</a>
                          ' : null;
      // Se o usuario logado já participa do evento aparece botão para sair, se não para participar               
      $resultados .= !empty($eventoUserLogado) ?
                        '  
                        <a href="../pages/sairEvento.php?id='.$evento->idEvento.'" class="btn btn-danger btn-sm">
                        Sair
                        </a>
                        ' : 
                        ' 
                        <a href="../pages/participarEvento.php?id='.$evento->idEvento.'" class="btn btn-success btn-sm">Participar
                        </a>
                        ';
      $resultados .=    '
                        <a href="../pages/detalhesEvento.php?id='.$evento->idEvento.'" class="btn btn-info btn-sm">Detalhes</a>
                        ';    
?> 
  <div class="cards_wrap">
      <div class="card_item">
        <div class="card_inner">
          <img src="../assets/img/imgCards.png">
          <div class="role_name"><?=$evento->nmEvento?></div>
          <div class="real_name">Criada por <?=$nmGrupoCriador?></div>
          <div class="film"><?=$evento->descEvento?></div>
          <div class="buttons">
            <?=$resultados?>
          </div>
        </div>
      </div>
  </div>
  <!-- Modal -->
<div class="modal fade" id="detalhesEvento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$evento->nmEvento?></h5>
      </div>
      <div class="modal-body">
      <?php
        
      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php
    }
 }
  echo empty($resultados) ? 'Nenhum evento aberto no momento ;(' : '';
?>
</div>

