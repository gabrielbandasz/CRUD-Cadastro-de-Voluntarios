<?php
session_start();
include("../config/conexao.php");

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM voluntarios WHERE id=$id";
$result = $conn->query($sql);
$voluntario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Voluntário</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">
<?php include("../includes/sidebar.php"); ?>
<div class="dashboard-container">

<div class="dashboard-card">

<h2 class="dashboard-title">Editar Voluntário</h2>

<form action="atualizar_voluntario.php" method="POST" class="form-voluntario-small">

<input type="hidden" name="id" value="<?php echo $voluntario['id']; ?>">

<div class="form-group">
<label>Nome</label>
<input type="text" name="nome" value="<?php echo $voluntario['nome']; ?>" required>
</div><br>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" value="<?php echo $voluntario['email']; ?>">
</div><br>

<div class="form-group">
<label>Telefone</label>
<input type="text" name="telefone" value="<?php echo $voluntario['telefone']; ?>">
</div><br>

<div class="form-btn">
<button type="submit" class="btn-primary">Salvar Alterações</button>
</div>

</form>

</div>

</div>

</body>
</html>