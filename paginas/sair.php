<?php
session_start();
unset($_SESSION['idUsuario']);
header("Location: ../index.php");
?>