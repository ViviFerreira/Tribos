<?php
Class Grupo {
    private $pdo;
    public function cadastrar($nome, $desc){
        global $pdo;
        // Verificar se a tribo já existe
        $sql = $pdo->prepare(
            "SELECT idGrupo FROM grupo WHERE nmGrupo = :n");
        $sql->bindValue(":n", $nome);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false;
        }
        else{
        // Caso não, Cadastrar
            $sql = $pdo->prepare("INSERT INTO grupo VALUES (DEFAULT, :n, :d)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":d", $desc);
            $sql->execute();
            return true;
        }
    }
}