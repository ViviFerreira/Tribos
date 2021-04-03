<?php
//Verificar se clicou no botão 
require_once('../classes/usuario.php');
$u = new Usuario;
if(isset($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    $senhaConf = addslashes($_POST['senhaConf']);

    //Verificar se está preenchido
    if(!empty($nome) && !empty($email) && !empty($senha) && !empty($senhaConf)){
        $u->conectar('dbTribos', 'localhost', "root", "");
        if($u->msgErro ==  ""){
             if($senha == $senhaConf){
                 if($u->cadastrar($nome, $email, $senha)){
                    echo "Cadastrado com sucesso! Acesse para entrar.";
                 }else{
                     echo "Email já cadastrado";
                 }
             }else{
                 echo "Senha e Confirmar senha não correspondem!";
             }
        }else{
            echo "Erro: ".$u->msgErro;
        }
    }else{
        echo "Preencha todos os campos!";
    }
}
    

