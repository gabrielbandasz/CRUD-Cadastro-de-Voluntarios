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

/* pegar nome do ministério */

$sql_min = "SELECT nome FROM ministerios WHERE id = $ministerio_id";
$result_min = $conn->query($sql_min);
$ministerio = $result_min->fetch_assoc();

/* pegar voluntários do ministério */

$sql_vol = "SELECT * FROM voluntarios WHERE ministerio_id = $ministerio_id";
$voluntarios = $conn->query($sql_vol);

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
<?php include("../includes/sidebar.php"); ?>
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

<h3 class="table-title">
Selecionar voluntários — <?php echo $ministerio['nome']; ?>
</h3>

<div class="ministerios-grid">

<?php

while($v = $voluntarios->fetch_assoc()){

echo "
<label class='voluntario-item'>

<input type='checkbox' name='voluntarios[]' value='".$v['id']."'>
<span>".$v['nome']."</span>

</label>
";

}

?>

</div>

<div class="form-btn">

<button type="submit" class="btn-primary">
Salvar Escala
</button>

</div>

</form>

</div>
</div>

</body>
</html>