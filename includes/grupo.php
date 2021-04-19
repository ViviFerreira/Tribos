<?php
//Verificar se clicou no botão 
function __autoload($class_name){
    require_once '../classes/' . $class_name . '.php';
}
require_once 'conexao.php';
$g = new Grupo;
if(isset($_POST['nmGrupo'])){ //SE CLICOU NO BOTÃO DE CADASTRAR OU EDITAR
    //----------------- EDITAR ----------------------//
    if(isset($_GET['idUp']) && !empty($_GET['idUp'])){
        $idUp = addslashes($_GET['idUp']);
        $nome = addslashes($_POST['nmGrupo']);
        $desc = addslashes($_POST['descGrupo']);
        if(!empty($nome) && !empty($desc)){//OPCIONAL
            $g->editarDadosGrupo($idUp, $nome, $desc);
            header("Location: formTribo.php");
        }else{
            echo "Preencha todos os campos";
            }
        }else{
        $nome = addslashes($_POST['nmGrupo']);
        $desc = addslashes($_POST['descGrupo']);
        // VERIFICAR SE ESTÁ PREENCHIDA
        if(!empty($nome) && !empty($desc)){
            if($g->cadastrar($nome, $desc)){
            ?>
                <script>
                    alert("Sua Tribo foi cadastrada com sucesso!");
                </script>
            <?php
                }else{
            ?>
                <script>
                    alert("Já existe uma tribo com esse nome!");
                </script>
            <?php
                }
        }else{
            ?>
                <script>
                    alert("Preencha todos os campos!");
                </script>
            <?php
        }
    
    }   

}
if(isset($_GET['idUp'])){ //SE CLICOU NO BOTÃO DE EDITAR
    $idUp = addslashes($_GET['idUp']);
    $arrayGrupo = $g->find($idUp);
}
if(isset($_GET['id'])){ //SE CLICOU NO BOTÃO DE EXCLUIR
    $idGrupo = addslashes($_GET['id']);
    $g->excluirGrupo($idGrupo);
    header("Location: formTribo.php");
}

    
