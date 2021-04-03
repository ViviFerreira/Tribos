<?php

Class Usuario {
    private $pdo;
    public $msgErro = "";
    public function conectar($name, $host, $user, $pass){
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$name.";host=".$host,$user,$pass);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $email, $senha){
        global $pdo;
        // Verificar se e-mail já existe
        $sql = $pdo->prepare(
            "SELECT idUsuario FROM usuario WHERE emailUsuario = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
        if($sql->rowCount() > 0){
            return false;
        }
        else{
        // Caso não, Cadastrar
            $sql = $pdo->prepare("INSERT INTO usuario VALUES (DEFAULT, :n, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email, $senha){
        global $pdo;
        $sql = $pdo->prepare(
            "SELECT idUsuario FROM usuario WHERE emailUsuario = :e AND senhaUsuario = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0){
        // Está cadastrada
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
        // Cria sessão 
            session_start();
            $_SESSION['idUsuario'] = $dado['idUsuario']; 
            return true; //Logado com sucesso
        }else{
        // Não está cadastrada
            return false;
        }

    }
}