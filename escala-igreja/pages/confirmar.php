<?php

include("../config/conexao.php");

$id = $_GET['id'];
$status = $_GET['status'];

$sql = "UPDATE escala_voluntarios
SET status='$status'
WHERE id=$id";

$conn->query($sql);

header("Location: minhas_escalas.php");

?>