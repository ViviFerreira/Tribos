<?php
require_once '../vendor/autoload.php';
define('TITLE','Cadastrar Tribo');
use \App\Entity\Grupo;
$obGrupo = new Grupo;
session_start();
if(!isset($_SESSION['idUsuario'])){
  header("Location: formLogin.php");
  exit;
}else{
    $idUsuarioLogado = $_SESSION['idUsuario'];
}
//Verificar se clicou no botão 
if(isset($_POST['nome'])){
    $obGrupo->nmGrupo = addslashes($_POST['nome']);
    $obGrupo->descGrupo = addslashes($_POST['desc']);
    $obGrupo->flAtivo = addslashes($_POST['status']);
    $obGrupo->idUsuarioCriou = addslashes($idUsuarioLogado);
    //Verificar se está preenchido
    if(!empty($obGrupo->nmGrupo) && !empty($obGrupo->descGrupo))
    {
        if($obGrupo->cadastrar())
        {
            header('location: inicio.php?status=success');
            exit;
        }else{
        ?>
            <script>
                alert("Esta tribo já está cadastrada, escolha outro nome");
            </script>
        <?php
        }
    }else
    {
        ?>
            <script>
                alert("Preencha todos os campos!");
            </script>
        <?php
    }
}
require_once '../includes/headerPages.php';
require_once '../includes/formGrupo.php';
require_once '../includes/footer.php';