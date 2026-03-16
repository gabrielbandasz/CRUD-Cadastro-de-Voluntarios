<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function enviarEmail($destino, $nome, $data, $culto){

$mail = new PHPMailer(true);

try{

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;

$mail->Username = 'SEUEMAIL@gmail.com';
$mail->Password = 'SUA_SENHA_APP';

$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('SEUEMAIL@gmail.com', 'Escala Igreja');

$mail->addAddress($destino, $nome);

$mail->isHTML(true);

$mail->Subject = 'Nova Escala';

$mail->Body = "
Olá <b>$nome</b><br><br>

Você foi escalado para:<br>

<b>Culto:</b> $culto<br>
<b>Data:</b> $data<br><br>

Entre no sistema para confirmar sua presença.

";

$mail->send();

}catch(Exception $e){

}

}