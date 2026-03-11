<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['usuario_id'])){
header("Location: ../login.php");
exit;
}

$usuario_id = $_SESSION['usuario_id'];

/* pegar email do usuario */

$sql_usuario = "SELECT email FROM usuarios WHERE id = $usuario_id";
$result_usuario = $conn->query($sql_usuario);
$usuario = $result_usuario->fetch_assoc();

$email = $usuario['email'];

/* achar voluntario */

$sql_voluntario = "SELECT id FROM voluntarios WHERE email='$email'";
$result_voluntario = $conn->query($sql_voluntario);
$voluntario = $result_voluntario->fetch_assoc();

$voluntario_id = $voluntario['id'];

/* buscar escalas */

$sql = "SELECT escalas.id, escalas.data, escalas.culto, escala_voluntarios.status
FROM escala_voluntarios
JOIN escalas ON escala_voluntarios.escala_id = escalas.id
WHERE escala_voluntarios.voluntario_id = $voluntario_id
ORDER BY escalas.data ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Minhas Escalas</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Minhas Escalas</h2>

<table class="table-modern">

<tr>
<th>Data</th>
<th>Culto</th>
<th>Status</th>
<th>Ação</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['data']."</td>";
echo "<td>".$row['culto']."</td>";

/* STATUS */

$status = $row['status'];

if($status == "confirmado"){
echo "<td class='status confirmado'>Confirmado</td>";
}
elseif($status == "recusado"){
echo "<td class='status recusado'>Recusado</td>";
}
else{
echo "<td class='status pendente'>Pendente</td>";
}

/* AÇÕES */

if($status == "pendente"){

echo "<td class='acoes'>
<a class='btn-action confirmar' href='confirmar.php?id=".$row['id']."&status=confirmado'>Confirmar</a>

<a class='btn-action recusar' href='confirmar.php?id=".$row['id']."&status=recusado'>Recusar</a>
</td>";

}else{

echo "<td>-</td>";

}

echo "</tr>";

}

?>

</table>

<br>

<a class="btn-action sair" href="../logout.php">Sair</a>

</div>
</div>

</body>
</html>