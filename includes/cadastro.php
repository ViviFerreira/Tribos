<?php
function __autoload($class_name){
    require_once '../classes/' . $class_name . '.php';
}
require_once 'conexao.php';
$u = new Usuario;

//Verificar se clicou no botão 
if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $senhaConf = addslashes($_POST['senhaConf']);

    //Verificar se está preenchido
    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($senhaConf)){
        if($senha == $senhaConf){
            if($u->cadastrar($nome, $email, $senha)){
        ?>
            <script>
                alert("Cadastrado com sucesso!");
            </script>
        <?php
            }else{
        ?>
            <script>
                alert("Este email já está cadastrado!");
            </script>
        <?php
            }
        }else{
        ?>
            <script>
                alert("Senha e Confirmar senha não correspondem!");
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
    

