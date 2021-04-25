<?php
  require_once '../vendor/autoload.php';
  use \App\Entity\GruposUsuario;
  $obGrupoUserLogado = new GruposUsuario;
  $idUsuarioLogado = $_SESSION['idUsuario'];
  // $GrupoUserLogado = $GrupoUserLogado->getGruposUsuario($idUsuarioLogado);
  
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
    $grupoUserLogado = $obGrupoUserLogado->getGrupoUsuario($idUsuarioLogado, $grupo->idGrupo);
    // Mostra tribos cadastradas
    $resultados .=  ' 
                    <tr>
                      <td>'.$grupo->nmGrupo.'</td>
                      <td>'.$grupo->descGrupo.'</td>
                    ';
    // Se o usuário logado foi quem criou a tribo, ele pode editar, excluir e participar              
    $resultados .= $idUsuarioLogado == $grupo->idUsuarioCriou ? 
                        '<td>
                            <a href="../pages/editarTribo.php?id='.$grupo->idGrupo.'">
                              <button type="button" class="btn btn-primary">Editar</button>
                            </a>
                          </td>
                        ' : null;
    // Se o usuario logado já participa da tribo aparece botão para sair                 
    $resultados .= !empty($grupoUserLogado)?
                      '  <td>
                          <a href="../pages/sairTribo.php?id='.$grupo->idGrupo.'">
                            <button type="button" class="btn btn-primary">Sair</button>
                          </a>
                        </td>
                      ' : 
                      ' <td>
                          <a href="../pages/participarTribo.php?id='.$grupo->idGrupo.'">
                          <button type="button" class="btn btn-danger">Participar</button>
                          </a>
                        </td>
                      ';
    }

  $resultados = strlen($resultados) ? $resultados : '<tr>
                                                       <td colspan="6" class="text-center">
                                                              Nenhuma tribo encontrada
                                                       </td>
                                                    </tr>';
?>
<main>

  <?=$mensagem?>
  <section>

    <table class="table bg-light mt-3">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <?=$resultados?>
            </tr>
        </tbody>
    </table>

  </section>

</main>