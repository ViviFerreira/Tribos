<?php
//Verificar se clicou no botão 
require_once('../class/usuario.php');
require_once('conexao.php');
$u = new Usuario;
if(isset($_POST['email'])){
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    //Verificar se está preenchido
    if(!empty($email) && !empty($senha)){
        if($u->logar($email, $senha)){
            header("Location: explorar.php");
        }else{
    ?>
            <script>
                alert("Email e/ou senha incorretos!");
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
    

