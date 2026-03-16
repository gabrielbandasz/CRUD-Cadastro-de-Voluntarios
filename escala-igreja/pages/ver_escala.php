<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$escala_id = $_GET['id'];

$sql = "SELECT * FROM escalas WHERE id = $escala_id";
$result = $conn->query($sql);
$escala = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>Ver Escala</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">
<?php include("../includes/sidebar.php"); ?>
<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Escala</h2>

<p><strong>Data:</strong> <?php echo $escala['data']; ?></p>
<p><strong>Culto:</strong> <?php echo $escala['culto']; ?></p>

<h3 class="table-title">Voluntários</h3>

<?php

$sql2 = "SELECT ministerios.nome AS ministerio, voluntarios.nome AS voluntario
FROM escala_voluntarios
JOIN voluntarios ON voluntarios.id = escala_voluntarios.voluntario_id
JOIN ministerios ON ministerios.id = voluntarios.ministerio_id
WHERE escala_voluntarios.escala_id = $escala_id
ORDER BY ministerios.nome";

$result2 = $conn->query($sql2);

$ministerio_atual = "";

while($row = $result2->fetch_assoc()){

if($ministerio_atual != $row['ministerio']){

$ministerio_atual = $row['ministerio'];

echo "<h4>".$ministerio_atual."</h4>";

}

echo "<p>• ".$row['voluntario']."</p>";

}

?>

<br>

<a class="btn-action ver" href="listar_escalas.php">Voltar</a>

</div>
</div>

</body>
</html>