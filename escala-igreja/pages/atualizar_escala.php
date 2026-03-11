<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$escala_id = $_POST['escala_id'];
$data = $_POST['data'];
$culto = $_POST['culto'];

$conn->query("UPDATE escalas SET data='$data', culto='$culto' WHERE id=$escala_id");

/* apagar voluntarios antigos */

$conn->query("DELETE FROM escala_voluntarios WHERE escala_id=$escala_id");

/* inserir novos */

if(isset($_POST['voluntarios'])){

foreach($_POST['voluntarios'] as $voluntario_id){

$conn->query("INSERT INTO escala_voluntarios (escala_id,voluntario_id)
VALUES ($escala_id,$voluntario_id)");

}

}

header("Location: listar_escalas.php");

?>