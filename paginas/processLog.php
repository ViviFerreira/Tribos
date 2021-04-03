<?php
//Verificar se clicou no botão 
require_once('../classes/usuario.php');
$u = new Usuario;
if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    //Verificar se está preenchido
    if(!empty($email) && !empty($senha)){
        $u->conectar('dbTribos', 'localhost', "root", "");
        if($u->msgErro ==  ""){
            if($u->logar($email, $senha)){
                header("Location: explorar.php");
            }else{
                echo "Email e/ou senha incorretos!";
            }
        }else{
            echo "Erro: ".$u->msgErro;
        }
    }else{
        echo "Preencha todos os campos!";
    }
}
    

