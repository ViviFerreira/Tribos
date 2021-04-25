<?php
require_once '../vendor/autoload.php';
use \App\Entity\Usuario;
$obUser = new Usuario;
//Verificar se clicou no botão 
if(isset($_POST['email'])){
    $obUser->emailUsuario = addslashes($_POST['email']);
    $obUser->senhaUsuario = addslashes($_POST['senha']);

    //Verificar se está preenchido
    if(!empty($obUser->emailUsuario) && !empty($obUser->senhaUsuario)){
        if($obUser->logar()){
            header("Location: ../pages/inicio.php");
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
    

