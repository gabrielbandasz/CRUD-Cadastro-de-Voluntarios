<?php

include("../config/conexao.php");

$id = $_GET['id'];

$sql = "DELETE FROM voluntarios WHERE id=$id";

if($conn->query($sql)){
    header("Location: voluntarios.php");
}else{
    echo "Erro ao excluir";
}

?>