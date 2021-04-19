<?php
    require_once '../includes/headPages.php';
    require_once '../includes/grupo.php';
?>
    <section class="container">

        
        <form method="post">
        <div class="mt-5 form-group">
            <label for="nmGrupo">Escolha um nome para sua tribo</label>
            <input type="text" class="form-control" name="nmGrupo" id="nmGrupo" autofocus autocomplete="off" placeholder="Digite o nome" maxlength="45" required value="<?php if(isset($arrayGrupo)){echo $arrayGrupo['nmGrupo'];}?>">
        </div>
        <div class="form-group">
            <label for="nmGrupo">Decreva sua Tribo</label>
            <input class="form-control" name="descGrupo" id="descGrupo" maxlength="200" value="<?php if(isset($arrayGrupo)){echo $arrayGrupo['descGrupo'];}?>">
        </div>
        <input type="submit" class="btn btn-primary"  value="<?php if(isset($arrayGrupo)){echo "Atualizar";}else{echo "Cadastrar";}?>">
        </form>
    </section>
    <table class="table bg-light mt-3">
            <tr id="titulo">
                    <td>Nome</td>
                    <td colspan="3">Descrição</td>
            </tr>
            <?php
                $dados = $g->findAll();
                if(count($dados) > 0){//EXISTEM DADOS
                    for($i=0; $i < count($dados); $i++){
                        echo "<tr>";
                        foreach ($dados[$i] as $k => $v) {
                            if($k != "idGrupo"){
                                echo "<td>".$v."</td>";
                            }
                        }
            ?>
                        <td>
                            <a href="formTribo.php?idUp=<?php echo $dados[$i]['idGrupo'];?>">Editar</a>
                            <a href="formTribo.php?id=<?php echo $dados[$i]['idGrupo'];?>">Excluir</a>
                        </td>
            </tr>
            <?php
                    }
                }else{ //NÃO EXISTEM DADOS
                    echo "Ainda não há Tribos cadastradas!";
                }
            ?>      
        </table>
<?php
   require_once '../includes/footer.php';
?>