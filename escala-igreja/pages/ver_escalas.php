<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$escala_id = $_GET['id'];

$sql = "SELECT voluntarios.nome, ministerios.nome AS ministerio, escala_voluntarios.status
FROM escala_voluntarios
JOIN voluntarios ON escala_voluntarios.voluntario_id = voluntarios.id
JOIN ministerios ON voluntarios.ministerio_id = ministerios.id
WHERE escala_voluntarios.escala_id = $escala_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>Voluntários da Escala</title>

<link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

<h2>Voluntários da Escala</h2>

<table border="1">

<tr>
<th>Nome</th>
<th>Ministério</th>
<th>Status</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>";
echo "<td>".$row['nome']."</td>";
echo "<td>".$row['ministerio']."</td>";
echo "<td>".$row['status']."</td>";
echo "</tr>";

}

?>

</table>

<br>

<a href="listar_escalas.php">Voltar</a>

</body>
</html>