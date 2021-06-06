<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use App\Entity\GruposUsuario;
  use App\Entity\Usuario;

  $obUsuariosGrupo = new GruposUsuario;
  $obUsuario = new Usuario;

  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }
  $grupoSetado = $_GET["id"];
  $partsGrupo = $obUsuariosGrupo -> getGruposUsuario('idGrupo ='.$grupoSetado);
  
  ?>

  <section class="table-evento"> 
    <h4 class="title-tribos"><i class="bi bi-people"></i> Participantes</h4>
    <ul class="list-group list-group-flush mt-3 text-center">
  <?php

  foreach($partsGrupo as $partGrupo){
    $idUsuario = $partGrupo->idUsuario;
    $partipante = $obUsuario->getUsuario($idUsuario);
    $nmParticipante = $partipante->nmUsuario;
  ?>
      <li class="list-group-item"><?=$nmParticipante?></li> 
  <?php
  }
  ?>
    </ul>
    <a href="inicio.php" type="button" class="btn btn-primary btn-sm mt-3 ml-4"><i class="bi bi-arrow-left"></i> Voltar</a>
  </section>
<?php
  require_once '../includes/footer.php';
?>