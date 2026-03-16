<?php

session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM ministerios WHERE id = $id";
$result = $conn->query($sql);

$ministerio = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Ministério</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">

<?php include("../includes/sidebar.php"); ?>

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Editar Ministério</h2>

<form action="atualizar_ministerio.php" method="POST">

<input type="hidden" name="id" value="<?php echo $ministerio['id']; ?>">

<div class="form-group">

<label>Nome do Ministério</label>

<input 
type="text" 
name="nome" 
value="<?php echo $ministerio['nome']; ?>"
required
>

</div>

<br>

<button class="btn-primary" type="submit">
Atualizar Ministério
</button>

</form>

</div>
</div>

</body>
</html>