<?php

include("../config/conexao.php");

$data = $_POST['data'];
$culto = $_POST['culto'];

$sql = "INSERT INTO escalas (data, culto) VALUES ('$data','$culto')";
$conn->query($sql);

$escala_id = $conn->insert_id;

if(isset($_POST['voluntarios'])){

foreach($_POST['voluntarios'] as $voluntario_id){

$sql2 = "INSERT INTO escala_voluntarios (escala_id, voluntario_id)
VALUES ($escala_id, $voluntario_id)";

$conn->query($sql2);

}

}

header("Location: escalas.php");

?>