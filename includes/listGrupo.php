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
  foreach($grupos as $grupo){
    $userCriador = $obUser->getUsuario($grupo->idUsuarioCriou);
    $nmUsuarioCriador = $userCriador->nmUsuario;

    $grupoUserLogado = $obGrupoUserLogado->getGrupoUsuario($idUsuarioLogado, $grupo->idGrupo);
    // Se o usuário logado foi quem criou a tribo, ele pode editar e participar              
    $resultados = $idUsuarioLogado == $grupo->idUsuarioCriou ? 
                        ' 
                        <a href="../pages/editarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-outline-dark">Editar</a>
                        ' : null;
    // Se o usuario logado já participa da tribo aparece botão para sair, se não para participar               
    $resultados .= !empty($grupoUserLogado) ?
                      '  
                      <a href="../pages/sairTribo.php?id='.$grupo->idGrupo.'" class="btn btn-outline-danger">
                      Sair
                      </a>
                      ' : 
                      ' 
                      <a href="../pages/participarTribo.php?id='.$grupo->idGrupo.'" class="btn btn-outline-success">Participar
                      </a>
                      ';
   
  $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td colspan="6" class="text-center">
                                                              Nenhuma tribo encontrada
                                                       </td>
                                                    </tr>';
?>
<div class="card" style="width: 18rem; display:inline-block">
  <div class="card-header">
    Criada por <?=$nmUsuarioCriador?>
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$grupo->nmGrupo?></h5>
    <p class="card-text"><?=$grupo->descGrupo?></p>
    <div class="btn-group" role="group" aria-label="Basic example">
      <?=$resultados?>
    </div>
  </div>
</div>

<?php
 }
?>

