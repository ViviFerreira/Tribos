<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Grupo;
  use \App\Entity\Evento;
  use App\Entity\EventosUsuario;

  $obGrupo = new Grupo; 
  $obEvento = new Evento; 
  $obUsuariosEvento = new EventosUsuario;
  session_start();
  if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
  }
  $eventoSetado = $_GET["id"];
  $evento = $obEvento->getEvento($eventoSetado);
  $dtEvento = new DateTime($evento->dtEvento);
  $hrEvento = new DateTime($evento->hrEvento);
  $dtCriado = new DateTime($evento->dtCriado);
  $usuariosEventoSetado = $obUsuariosEvento->getEventosUsuario('idEvento ='.$eventoSetado);
  $parts = count($usuariosEventoSetado);
  $flEventoPrivado = ($evento->flEventoPrivado == "s") ? "Sim" : "Não";  
  ?>
 <section class="table-evento">
  <div class="card text-center">
    <div class="card-header color-table-bh">
      Detalhes do Evento : <?=$evento->nmEvento?>
    </div>
    <div class="card-body color-table">
      <div class="table-responsive">
        <table class="table table-borderless">
          <thead>
            <tr>
              <th scope="col">Descrição</th>
              <th scope="col">Data</th>
              <th scope="col">Hora</th>
              <th scope="col">Partipantes/Total</th>
              <th scope="col">Privado</th>
              <th scope="col">Local</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?=$evento->descEvento?></td>
              <td><?=$dtEvento->format("m/d/y")?></td>
              <td> <?=$hrEvento->format("H:i")?></td>
              <td><?=$parts?>/<?=$evento->qtPartsEvento?></td>
              <td><?=$flEventoPrivado?></td>
              <td><?=$evento->localEvento?>, <?=$evento->numLocalEvento?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer color-table-bh">
      Criado em <?=$dtEvento->format("m/d/y H:i")?>
    </div>
  </div>
  <a href="eventosAbertos.php" type="button" class="btn btn-primary btn-sm mt-3 ml-4"><i class="bi bi-arrow-left"></i> Voltar</a>
</section>
<?php
  require_once '../includes/footer.php';
?>