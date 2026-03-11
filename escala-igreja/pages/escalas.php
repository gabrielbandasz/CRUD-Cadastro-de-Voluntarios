<?php
session_start();

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

include("../config/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criar Escala</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Criar Escala</h2>
<br>
<form action="salvar_escala.php" method="POST">

<div class="form-grid">

<div class="form-group">
<label>Data</label>
<input type="date" name="data" required>
</div>

<div class="form-group">
<label>Culto</label>
<select name="culto">
<option value="Culto da Família">Culto da Família</option>
<option value="Culto de Oração">Culto de Oração</option>
<option value="Culto de Jovens">Culto de Jovens</option>
<option value="Especial">Especial</option>
</select>
</div>

</div>

<h3 class="table-title">Selecionar voluntários</h3>

<div class="ministerios-grid">

<?php

$sql = "SELECT ministerios.id AS ministerio_id, ministerios.nome AS ministerio_nome
FROM ministerios";

$ministerios = $conn->query($sql);

while($m = $ministerios->fetch_assoc()){

echo "<div class='ministerio-card'>";
echo "<h4>".$m['ministerio_nome']."</h4>";

$sql2 = "SELECT * FROM voluntarios WHERE ministerio_id=".$m['ministerio_id'];
$result = $conn->query($sql2);

while($v = $result->fetch_assoc()){

echo "
<label class='voluntario-item'>
<input type='checkbox' name='voluntarios[]' value='".$v['id']."'>
<span>".$v['nome']."</span>
</label>
";

}

echo "</div>";

}

?>

</div>

<div class="form-btn">
<button type="submit" class="btn-primary">Salvar Escala</button>
</div>

</form>

</div>
</div>

</body>
</html>