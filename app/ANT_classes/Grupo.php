<?php
namespace Classes;
use \PDO;
Class Grupo {
    private $table = 'grupo';
    private $pdo;
    // CADASTRAR GRUPO
    public function cadastrar($nome, $desc){
        global $pdo;
        // VERIFICAR SE O GRUPO JÁ EXISTE
        $sql = $pdo->prepare("SELECT idGrupo FROM $this->table WHERE nmGrupo = :n");
        $sql->bindValue(":n", $nome);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false;
        }
        else{
        // CASO NÃO CADASTRAR
            $sql = $pdo->prepare("INSERT INTO $this->table VALUES (DEFAULT, :n, :d)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":d", $desc);
            $sql->execute();
            return true;
        }
    }

     // BUSCAR DADOS DA TABELA
     public function findAll(){
        global $pdo;
        $lista = array();
        $sql = $pdo->query("SELECT * FROM $this->table ORDER BY nmGrupo");
        $lista = $sql->fetch(PDO::FETCH_ASSOC);//TRAZER SOMENTE ID DO BANCO
        return $lista;
     }

    //BUSCAR DADOS PESSOAS POR ID
    public function find($id){
        global $pdo;
        $consulta = array();
        $sql = $pdo->prepare("SELECT * FROM $this->table WHERE idGrupo = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
            $consulta = $sql->fetch(PDO::FETCH_ASSOC);
            return $consulta;
    }
    //ATUALIZAR DADOS NO BANCO DE DADOS
    public function editarDadosGrupo($id, $nome, $desc){
        global $pdo;
        $sql= $pdo->prepare("UPDATE $this->table SET nmGrupo = :n, descGrupo = :d WHERE idGrupo = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":d", $desc);
        $sql->execute();
    
    }
    
    public function excluirGrupo($id){
        global $pdo;
        $sql= $pdo->prepare("DELETE FROM $this->table WHERE idGrupo = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

}
