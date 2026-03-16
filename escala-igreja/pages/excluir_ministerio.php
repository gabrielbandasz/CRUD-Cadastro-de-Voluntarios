<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$id = $_GET['id'];

$sql = "DELETE FROM ministerios WHERE id=$id";

$conn->query($sql);

header("Location: ministerios.php");
exit;

?>