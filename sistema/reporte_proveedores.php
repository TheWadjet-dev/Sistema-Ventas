<?php
require('factura/fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 16);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70, 10, 'Reporte Empleados', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(20, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'RUC', 1, 0, 'C', 0);
        $this->Cell(50, 10, 'Proveedor', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Telefono', 1, 0, 'C', 0);
        $this->Cell(40, 10, 'Direccion', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

include('../conexion.php');
$consulta = "SELECT * FROM proveedor";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

while ($dato = $resultado->fetch_assoc()) {
    $pdf->Cell(20, 10, $dato['codproveedor'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $dato['RUC'], 1, 0, 'C', 0);
    $pdf->Cell(50, 10, $dato['proveedor'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $dato['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $dato['direccion'], 1, 1, 'C', 0);
}
$pdf->Output();
