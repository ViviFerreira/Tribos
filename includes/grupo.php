<?php
//Verificar se clicou no botão 
function __autoload($class_name){
    require_once '../classes/' . $class_name . '.php';
}
require_once 'conexao.php';
$g = new Grupo;
if(isset($_POST['nTribo'])){
    $nome = addslashes($_POST['nTribo']);
    $desc = addslashes($_POST['dTribo']);

    //Verificar se está preenchido
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
    

