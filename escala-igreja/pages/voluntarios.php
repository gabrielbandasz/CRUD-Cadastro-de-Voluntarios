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

<title>Voluntários</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">

<div class="dashboard-container">

<div class="dashboard-card-large">

<h2 class="dashboard-title">Cadastrar Voluntário</h2>

<form action="salvar_voluntario.php" method="POST" class="form-voluntario">

<div class="form-group">
<label>Nome</label>
<input type="text" name="nome" placeholder="Digite o nome do voluntário" required>
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" placeholder="Digite o email">
</div>

<div class="form-group">
<label>Telefone</label>
<input type="text" name="telefone" placeholder="Digite o telefone">
</div>

<div class="form-group">
<label>Ministério</label>

<select name="ministerio_id" required>

<option value="">Selecione o ministério</option>



<?php

$sql = "SELECT * FROM ministerios";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
echo "<option value='".$row['id']."'>".$row['nome']."</option>";
}

?>

</select>

</div>

<div class="form-btn">
<button type="submit" class="btn-primary">Cadastrar Voluntário</button>
</div>

</form>


<h2 class="table-title">Voluntários cadastrados</h2>

<div class="table-container">

<table class="styled-table">

<tr>
<th>Nome</th>
<th>Email</th>
<th>Telefone</th>
<th>Ministério</th>
<th>Ações</th>
</tr>

<?php

$sql = "SELECT voluntarios.*, ministerios.nome AS ministerio_nome
FROM voluntarios
LEFT JOIN ministerios
ON voluntarios.ministerio_id = ministerios.id";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['nome']."</td>";
echo "<td>".$row['email']."</td>";
echo "<td>".$row['telefone']."</td>";
echo "<td>".$row['ministerio_nome']."</td>";

echo "<td>

<a class='btn-edit' href='editar_voluntario.php?id=".$row['id']."'>Editar</a>

<a class='btn-delete' href='excluir_voluntario.php?id=".$row['id']."'>Excluir</a>

</td>";

echo "</tr>";

}

?>

</table>

</div>

</div>
</div>

</body>
</html>