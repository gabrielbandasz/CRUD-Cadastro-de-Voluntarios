<?php
session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$sql = "SELECT * FROM ministerios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Ministérios</title>

<link rel="stylesheet" href="../style.css">
</head>

<body class="dashboard-body">

<?php include("../includes/sidebar.php"); ?>

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Ministérios</h2>

<a class="btn-primary" href="criar_ministerio.php">
Novo Ministério
</a>

<br><br>

<table class="table-modern">

<tr>
<th>ID</th>
<th>Nome</th>
<th>Ações</th>
</tr>

<?php

while($m = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$m['id']."</td>";

echo "<td>".$m['nome']."</td>";

echo "<td>

<a class='btn-action editar' href='editar_ministerio.php?id=".$m['id']."'>
Editar
</a>

<a class='btn-action excluir' href='excluir_ministerio.php?id=".$m['id']."'>
Excluir
</a>

</td>";

echo "</tr>";

}

?>

</table>

</div>
</div>

</body>
</html>