<?php
session_start();

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

include("../config/conexao.php");

/* pegar ministerio do líder */

$usuario_id = $_SESSION['usuario_id'];

$sql_user = "SELECT ministerio_id FROM usuarios WHERE id = $usuario_id";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

$ministerio_id = $user['ministerio_id'];

/* buscar escalas apenas do ministério */

$sql = "SELECT escalas.*
FROM escalas
JOIN escala_voluntarios 
ON escalas.id = escala_voluntarios.escala_id
JOIN voluntarios 
ON voluntarios.id = escala_voluntarios.voluntario_id
WHERE voluntarios.ministerio_id = $ministerio_id
GROUP BY escalas.id
ORDER BY escalas.data DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Escalas</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">
<?php include("../includes/sidebar.php"); ?>
<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Escalas cadastradas</h2>

<table class="table-modern">

<tr>
<th>Data</th>
<th>Culto</th>
<th>Voluntários</th>
<th>Ações</th>
</tr>

<?php

while($escala = $result->fetch_assoc()){

$escala_id = $escala['id'];

echo "<tr>";

echo "<td>".$escala['data']."</td>";
echo "<td>".$escala['culto']."</td>";

$sql2 = "SELECT voluntarios.nome
FROM escala_voluntarios
JOIN voluntarios 
ON voluntarios.id = escala_voluntarios.voluntario_id
WHERE escala_voluntarios.escala_id = $escala_id";

$result2 = $conn->query($sql2);

$nomes = [];

while($v = $result2->fetch_assoc()){
$nomes[] = $v['nome'];
}

echo "<td>".implode(", ", $nomes)."</td>";

echo "<td class='acoes'>";

echo "<a class='btn-action ver' href='ver_escala.php?id=".$escala_id."'>Ver</a>";

echo "<a class='btn-action editar' href='editar_escala.php?id=".$escala_id."'>Editar</a>";

echo "<a class='btn-action excluir' href='excluir_escala.php?id=".$escala_id."' 
onclick='return confirm(\"Tem certeza que deseja excluir esta escala?\")'>
Excluir
</a>";
echo "<a class='btn-action pdf' href='gerar_pdf.php?id=".$escala_id."' target='_blank'>PDF</a>";

echo "</td>";

echo "</tr>";

}

?>

</table>

</div>
</div>

</body>
</html>