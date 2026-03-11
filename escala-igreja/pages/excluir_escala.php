<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$id = $_GET['id'];

/* apagar voluntarios da escala */

$conn->query("DELETE FROM escala_voluntarios WHERE escala_id = $id");

/* apagar escala */

$conn->query("DELETE FROM escalas WHERE id = $id");

header("Location: listar_escalas.php");

?>