<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';

  use App\Entity\Grupo;
  use App\Entity\GruposUsuario;
  use App\Entity\Usuario;

  $obUsuariosGrupo = new GruposUsuario;
  $obUsuario = new Usuario;
  $obGrupo = new Grupo;

  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }
  //Consultando participantes
  $grupoSetado = $_GET["id"];
  $partsGrupo = $obUsuariosGrupo->getGruposUsuario('idGrupo ='.$grupoSetado);
  
  //Verificando se não existem participantes 
  $resultado = empty($partsGrupo) ? '
    <div class="container">
        <div class="alert alert-warning mt-5 mb-5" role="alert">
            <i class="bi bi-emoji-smile-upside-down-fill"></i> Nenhum participante até o momento!
         </div> 
    </div>' 
                                   : null;
    //Consultando grupo setado
    $obGrupo = $obGrupo->getGrupo($grupoSetado);
    $nmGrupo = $obGrupo->nmGrupo;
                                
  ?>

  <section class="parts-eventos"> 
    <h4 class="title-tribos"><i class="bi bi-people"></i> Participantes da Tribo: <?=$nmGrupo?></h4>
    <?=$resultado?>
    <ul class="list-group list-group-flush mt-3 text-left">
  <?php

  foreach($partsGrupo as $partGrupo){
    $idUsuario = $partGrupo->idUsuario;
    $partipante = $obUsuario->getUsuario($idUsuario);
    $nmParticipante = $partipante->nmUsuario;
  ?>
      <li class="list-group-item parts"><?=$nmParticipante?></li> 
  <?php
  }
  ?>
    </ul>
    <a href="inicio.php" type="button" class="btn btn-primary btn-sm mt-4"><i class="bi bi-arrow-left"></i> Voltar</a>
  </section>
<?php
  require_once '../includes/footer.php';
?>