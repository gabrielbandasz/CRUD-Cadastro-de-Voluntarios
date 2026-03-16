<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$nome = $_POST['nome'];

$sql = "INSERT INTO ministerios (nome)
VALUES ('$nome')";

$conn->query($sql);

header("Location: ministerios.php");
exit;

?>