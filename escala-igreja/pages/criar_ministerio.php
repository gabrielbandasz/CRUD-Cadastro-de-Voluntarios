<?php
session_start();

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Criar Ministério</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">

<?php include("../includes/sidebar.php"); ?>

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Novo Ministério</h2>

<form action="salvar_ministerio.php" method="POST">

<div class="form-group">

<label>Nome do Ministério</label>

<input 
type="text" 
name="nome" 
placeholder="Ex: Louvor, Mídia, Recepção..." 
required
>

</div>

<br>

<button class="btn-primary" type="submit">
Salvar Ministério
</button>

</form>

</div>
</div>

</body>
</html>