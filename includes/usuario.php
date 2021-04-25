<?php
require_once '../vendor/autoload.php';
use \App\Entity\Usuario;
$obUser = new Usuario;
//Verificar se clicou no botão 
if(isset($_POST['nome'])){
    $obUser->nmUsuario = addslashes($_POST['nome']);
    $obUser->emailUsuario = addslashes($_POST['email']);
    $obUser->senhaUsuario = addslashes($_POST['senha']);
    $senhaConf = addslashes($_POST['senhaConf']);

    //Verificar se está preenchido
    if(!empty($obUser->nmUsuario) && !empty($obUser->emailUsuario) && !empty($obUser->senhaUsuario) && !empty($senhaConf))
    {
        if($obUser->senhaUsuario == $senhaConf)
        {
            if($obUser->cadastrar()){
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
        }else {
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