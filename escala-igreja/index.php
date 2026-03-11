<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sistema de Escala - OBPC</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="dashboard-body">

<div class="dashboard-container">

<div class="dashboard-card">

<h1 class="dashboard-title">Escalas da OBPC</h1>
<p class="dashboard-subtitle">Painel administrativo</p>

<div class="menu">

<a href="pages/voluntarios.php" class="menu-btn">
Cadastrar Voluntários
</a>

<a href="pages/escalas.php" class="menu-btn">
Criar Escala
</a>

<a href="pages/listar_escalas.php" class="menu-btn">
Ver Escalas
</a>

<a href="logout.php" class="menu-btn logout">
Sair
</a>

</div>

</div>

</div>

</body>
</html>