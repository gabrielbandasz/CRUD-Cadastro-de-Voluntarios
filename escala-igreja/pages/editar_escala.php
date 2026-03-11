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

/* voluntarios ja na escala */

$voluntarios_escala = [];

$sql2 = "SELECT voluntario_id FROM escala_voluntarios WHERE escala_id = $escala_id";
$result2 = $conn->query($sql2);

while($v = $result2->fetch_assoc()){
$voluntarios_escala[] = $v['voluntario_id'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Escala</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Editar Escala</h2>

<form action="atualizar_escala.php" method="POST" class="form-voluntario">

<input type="hidden" name="escala_id" value="<?php echo $escala_id; ?>">

<div class="form-group">
<label>Data</label>
<input type="date" name="data" value="<?php echo $escala['data']; ?>">
</div>

<div class="form-group">
<label>Culto</label>
<input type="text" name="culto" value="<?php echo $escala['culto']; ?>">
</div>

</form>

<h3 class="table-title">Voluntários</h3>

<div class="voluntarios-grid">

<?php

$sql3 = "SELECT * FROM voluntarios";
$result3 = $conn->query($sql3);

while($vol = $result3->fetch_assoc()){

$checked = in_array($vol['id'], $voluntarios_escala) ? "checked" : "";

echo "
<label class='voluntario-item'>
<input type='checkbox' name='voluntarios[]' value='".$vol['id']."' $checked>
<span>".$vol['nome']."</span>
</label>
";

}

?>

</div>

<div class="form-btn">

<button type="submit" class="btn-primary">Salvar Alterações</button>

</div>

</form>

</div>
</div>

</body>
</html>