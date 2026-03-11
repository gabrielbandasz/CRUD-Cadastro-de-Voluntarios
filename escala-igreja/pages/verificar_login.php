<?php

session_start();
include("../config/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$usuario = $result->fetch_assoc();

$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['tipo'] = $usuario['tipo'];

if($usuario['tipo'] == "admin"){

header("Location: ../index.php");

}else{

header("Location: minhas_escalas.php");

}

}else{

echo "Email ou senha incorretos";

}

?>