<?php
require('pdf/fpdf.php');

include_once 'conexion.php';
$sentencia_select=$conn->prepare('SELECT * FROM costos ORDER BY id DESC');
$sentencia_select->execute();
$resultado=$sentencia_select->fetchAll();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Cell(15,10,'id',1,0,'C',0);
$pdf->Cell(30,10,'concepto',1,0,'C',0);
$pdf->Cell(30,10,'opciones',1,0,'C',0);
$pdf->Cell(25,10,'cantidad',1,0,'C',0);
$pdf->Cell(20,10,'costo',1,0,'C',0);
$pdf->Cell(55,10,'fecha',1,0,'C',0);
$pdf->Cell(20,10,'total',1,0,'C',0);
$pdf->Ln();
foreach($resultado as $row):
    $pdf->Cell(15,10,$row['id'],1,0,'C',0);
    $pdf->Cell(30,10,$row['concepto'],1,0,'C',0);
    $pdf->Cell(30,10,$row['opciones'],1,0,'C',0);
    $pdf->Cell(25,10,$row['cantidad'],1,0,'C',0);
    $pdf->Cell(20,10,$row['costo'],1,0,'C',0);
    $pdf->Cell(55,10,$row['fecha'],1,0,'C',0);
    $pdf->Cell(20,10,$row['total'],1,0,'C',0);
    $pdf->Ln();
endforeach;

$pdf->Output();
?>