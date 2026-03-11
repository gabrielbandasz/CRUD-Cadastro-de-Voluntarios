<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Escala Igreja</title>

<link rel="stylesheet" href="style.css">

</head>

<body class="login-body">

<div class="login-container">

<div class="login-card">

<h2 class="login-title">Login</h2>

<form action="pages/verificar_login.php" method="POST">

<div class="input-group">
<input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
<input type="password" name="senha" placeholder="Senha" required>
</div>

<button class="login-btn">Entrar</button>

</form>

</div>

</div>

</body>

</html>