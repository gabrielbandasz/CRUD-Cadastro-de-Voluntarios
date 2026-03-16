<?php

session_start();
include("../config/conexao.php");

require("../fpdf/fpdf.php");

/* PEGAR ID DA ESCALA */
$escala_id = $_GET['id'];

/* BUSCAR ESCALA */

$sql = "SELECT * FROM escalas WHERE id = $escala_id";
$result = $conn->query($sql);
$escala = $result->fetch_assoc();

$data = date("d/m/Y", strtotime($escala['data']));
$culto = $escala['culto'];

/* BUSCAR VOLUNTÁRIOS */

$sql2 = "SELECT voluntarios.nome, escala_voluntarios.status
FROM escala_voluntarios
JOIN voluntarios ON voluntarios.id = escala_voluntarios.voluntario_id
WHERE escala_voluntarios.escala_id = $escala_id";

$result2 = $conn->query($sql2);

/* CRIAR PDF */

$pdf = new FPDF();
$pdf->AddPage();

/* NOME DA IGREJA */

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'OBPC Esteio',0,1,'C');

/* TÍTULO */

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'Escala de Voluntarios',0,1,'C');

$pdf->Ln(5);

/* INFORMAÇÕES DA ESCALA */

$pdf->SetFont('Arial','',12);

$pdf->Cell(0,8,"Culto: $culto",0,1);
$pdf->Cell(0,8,"Data: $data",0,1);

$pdf->Ln(5);

/* CABEÇALHO DA TABELA */

$pdf->SetFont('Arial','B',12);

$pdf->Cell(130,10,'Voluntario',1,0,'C');
$pdf->Cell(60,10,'Status',1,1,'C');

/* DADOS */

$pdf->SetFont('Arial','',12);

while($v = $result2->fetch_assoc()){

$status = $v['status'];

if($status == "confirmado"){
$status = "Confirmado";
}
elseif($status == "recusado"){
$status = "Recusado";
}
else{
$status = "Pendente";
}

$pdf->Cell(130,10,$v['nome'],1);
$pdf->Cell(60,10,$status,1,1);

}

/* GERAR PDF */

$pdf->Output();

?>