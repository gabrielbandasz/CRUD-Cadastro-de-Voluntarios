<?php

include("../config/conexao.php");

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$sql = "UPDATE voluntarios 
SET nome='$nome', email='$email', telefone='$telefone'
WHERE id=$id";

if($conn->query($sql)){
    header("Location: voluntarios.php");
}else{
    echo "Erro ao atualizar";
}

?>