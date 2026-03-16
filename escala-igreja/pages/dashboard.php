<?php
session_start();

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'admin'){
header("Location: ../login.php");
exit;
}

include("../config/conexao.php");

$usuario_id = $_SESSION['usuario_id'];

/* pegar ministerio do lider */

$sql_user = "SELECT ministerio_id FROM usuarios WHERE id = $usuario_id";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

$ministerio_id = $user['ministerio_id'];

/* total voluntarios */

$sql_vol = "SELECT COUNT(*) as total 
FROM voluntarios 
WHERE ministerio_id = $ministerio_id";

$result_vol = $conn->query($sql_vol);
$total_vol = $result_vol->fetch_assoc()['total'];

/* escalas do mes */

$sql_esc = "SELECT COUNT(DISTINCT escalas.id) as total
FROM escalas
JOIN escala_voluntarios 
ON escalas.id = escala_voluntarios.escala_id
JOIN voluntarios 
ON voluntarios.id = escala_voluntarios.voluntario_id
WHERE voluntarios.ministerio_id = $ministerio_id
AND MONTH(escalas.data) = MONTH(CURDATE())";

$result_esc = $conn->query($sql_esc);
$total_esc = $result_esc->fetch_assoc()['total'];

/* confirmacoes pendentes */

$sql_pend = "SELECT COUNT(*) as total
FROM escala_voluntarios
JOIN voluntarios 
ON voluntarios.id = escala_voluntarios.voluntario_id
WHERE voluntarios.ministerio_id = $ministerio_id
AND escala_voluntarios.status = 'pendente'";

$result_pend = $conn->query($sql_pend);
$total_pend = $result_pend->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link rel="stylesheet" href="../style.css">

</head>

<body class="dashboard-body">
<?php include("../includes/sidebar.php"); ?>
<div class="dashboard-container-lider">

<h2 class="dashboard-titulo-lider">Painel do Líder</h2>

<div class="stats-grid">

<div class="stat-card">
<h3>Voluntários</h3>
<p><?php echo $total_vol; ?></p>
</div>

<div class="stat-card">
<h3>Escalas este mês</h3>
<p><?php echo $total_esc; ?></p>
</div>

<div class="stat-card">
<h3>Pendentes</h3>
<p><?php echo $total_pend; ?></p>
</div>

</div>

</div>

</body>
</html>