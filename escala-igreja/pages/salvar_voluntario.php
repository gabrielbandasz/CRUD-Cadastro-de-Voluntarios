<?php

include("../config/conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$ministerio_id = $_POST['ministerio_id'];

$sql = "INSERT INTO voluntarios (nome,email,telefone,ministerio_id)
VALUES ('$nome','$email','$telefone','$ministerio_id')";

$conn->query($sql);

/* cria login automaticamente */

$senha = $telefone;

$sql_usuario = "INSERT INTO usuarios (nome,email,senha,tipo)
VALUES ('$nome','$email','$senha','voluntario')";

$conn->query($sql_usuario);

header("Location: voluntarios.php");

?>