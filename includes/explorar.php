<?php
require_once '../includes/conexao.php';
session_start();
if(!isset($_SESSION['idUsuario'])){
    header("Location: formLogin.php");
    exit;
}else{
    $userLogado = $_SESSION['idUsuario'];
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE idUsuario = :id");    
    $sql->bindValue(":id", $userLogado);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
    $nmUsuario = $user['nmUsuario'];
}