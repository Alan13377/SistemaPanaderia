<?php
require('pdf/fpdf.php');
include_once 'conexion.php';
$sentencia_select = $conn->prepare('SELECT * FROM activo ORDER BY id DESC');
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
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);

$pdf->Cell(40, 10, 'id', 1, 0, 'C', 0);
$pdf->Cell(40, 10, 'concepto', 1, 0, 'C', 0);
$pdf->Cell(40, 10, 'categoria', 1, 0, 'C', 0);
$pdf->Cell(35, 10, 'costo', 1, 0, 'C', 0);
$pdf->Cell(40, 10, 'fecha', 1, 0, 'C', 0);
$pdf->Ln();
foreach ($resultado as $row) :
    $pdf->Cell(40, 10, $row['id'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['concepto'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['categoria'], 1, 0, 'C', 0);
    $pdf->Cell(35, 10, $row['costo'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $row['fecha'], 1, 0, 'C', 0);
    $pdf->Ln();
endforeach;


$pdf->Output();
