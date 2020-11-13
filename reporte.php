<?php
require('pdf/fpdf.php');
include_once 'conexion.php';
$sentencia_select = $conn->prepare('SELECT * FROM costos ORDER BY id DESC');
$sentencia_select->execute();
$resultado = $sentencia_select->fetchAll();


class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo

        $this->SetFont('Arial', 'B', 20);
        // Movernos a la derecha
        $this->Cell(-45);
        // Título
        $this->Cell(276, 10, 'REPORTE DE GASTOS', 0, 0, 'C');
        // Salto de línea

        $this->Image('bread.png', 190, 5, 20, 20, 'png');
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('portrait', 'letter');
$pdf->SetFont('Arial', 'BU', 12);
$pdf->setY(30);
$pdf->SetTextColor(16, 87, 97);
$pdf->Cell(0, 5, 'Listado de Gastos Pasivos', 0, 0, 'C');
$pdf->Ln(30);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFillColor(11, 63, 71);
$pdf->SetTextColor(200, 200, 200);
$pdf->Cell(15, 10, 'id', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'concepto', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'opciones', 1, 0, 'C', 1);
$pdf->Cell(25, 10, 'cantidad', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'costo', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'fecha', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'total', 1, 0, 'C', 1);
$pdf->SetDrawColor(61, 174, 233);
$pdf->SetLineWidth(1);
$pdf->Line(10, 95, 205, 95);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(240, 240, 240);
$pdf->SetTextColor(40, 40, 40);
$pdf->SetDrawColor(255, 255, 255);

$pdf->Ln();
foreach ($resultado as $row) :
    $pdf->SetTextColor(16, 87, 97);
    $pdf->Cell(15, 10, $row['id'], 1, 0, 'C', 1);
    $pdf->Cell(30, 10, $row['concepto'], 1, 0, 'C', 1);
    $pdf->Cell(30, 10, $row['opciones'], 1, 0, 'C', 1);
    $pdf->Cell(25, 10, $row['cantidad'], 1, 0, 'C', 1);
    $pdf->Cell(20, 10, $row['costo'], 1, 0, 'C', 1);
    $pdf->Cell(55, 10, $row['fecha'], 1, 0, 'C', 1);
    $pdf->Cell(20, 10, $row['total'], 1, 0, 'C', 1);
    $pdf->Ln();
endforeach;



$pdf->Output();
