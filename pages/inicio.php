<?php
  require_once '../includes/headerPages.php';
  require_once '../vendor/autoload.php';
  use \App\Entity\Usuario;
  use \App\Entity\Grupo;
  use \App\Db\Pagination;

  $obUser = new Usuario; 
  $obGrupo = new Grupo; 
  session_start();
  if(!isset($_SESSION["idUsuario"])){
      header("Location: formLogin.php");
      exit;
    }else{
      $userLogado = $obUser->getUsuario($_SESSION['idUsuario']);
      $nmUsuario = $userLogado->nmUsuario;
    }
  
  //BUSCA
  $busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
  
  //FILTRO STATUS
  $filtroStatus = filter_input(INPUT_GET, 'filtroStatus', FILTER_SANITIZE_STRING);
  
  $filtroStatus = in_array($filtroStatus,['s','n']) ? $filtroStatus : '';
  
  //CONDIÇÕES SQL
  $condicoes = [
    strlen($busca) ? 'nmGrupo LIKE "%'.str_replace(' ','%',$busca).'%"' : null
    ,strlen($filtroStatus) ? 'flAtivo = "'.$filtroStatus.'"' : null
  ];

  //REMOVE POSIÇÕES VAZIAS
  $condicoes = array_filter($condicoes); 

  //CLÁUSULA WHERE 
  $where = implode(' AND ',$condicoes);
  
  //QUANTIDADE TOTAL DE GRUPOS
  $qntGrupos = $obGrupo->getQntGrupos($where);
  
  //PAGINAÇÃO 
  $obPagination = new Pagination($qntGrupos, $_GET['pagina'] ?? 1, 9);
  $limit = $obPagination->getLimit();

  //OBTEM AS TRIBOS
  $grupos = $obGrupo->getGrupos($where, null, null, $limit);

  $result = '';
  $result = empty($grupos) ? '
  <div class="container">
      <div class="alert alert-warning mt-5" role="alert">
        <i class="bi bi-emoji-smile-upside-down-fill"></i> 
        Nenhuma tribo encontrada!
      </div>
  </div>
  ': '';
  $mensagem = '';
  if(isset($_GET['status'])){
    switch ($_GET['status']) {
      case 'success': 
        $mensagem = ' 
                <div class="container">
                  <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="bi bi-check-square-fill"></i> Pronto! Ação realizada com sucesso
                  </div>
                </div>
                  ';
        break;
      case 'error':
        $mensagem = '
              <div class="container">
                <div class="alert alert-danger alert-dismissible fade show alert-red" role="alert"><i class="bi bi-exclamation-triangle"></i> Ops! Erro ao executar ação
                </div>
              </div>
                    ';
        break;
    }
  }

  ?>
  <section class="dash">
    <div class="jumbotron dash">
      <h3 class="display-4 wellcome">Seja Bem-Vindo(a) à Tribos, <?=$nmUsuario?>!</h3>
      <p class="lead text-dark">A Tribos é uma plataforma criada para contribuir no âmbito social, nosso foco é a união!</p>
      <hr class="my-4">
      <a href="cadastrarTribo.php"><button class="btn btn-primary btn-sm" href="#"><i class="bi bi-people-fill"></i> Criar uma tribo</button>
    </a>
    </div>
    <?=$mensagem?>
  </section>
  <section class="tribos">
    <h4 class="title-tribos"><i class="bi bi-people"></i> Tribos</h4>
    <?php
        require_once '../includes/listGrupo.php';
    ?>
        <?=$result?>
  </section>
  <?php
    require_once '../includes/footer.php';
  ?>
