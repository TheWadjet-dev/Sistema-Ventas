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
        $this->Cell(100);
        // Título
        $this->Cell(70, 10, 'Reporte Compras', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(30, 10, 'Proveedor', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Codigo', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'Producto', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Precio', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Cantidad', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'Fecha Ingreso', 1, 1, 'C', 0);
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
$consulta = "SELECT * FROM producto";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

while ($dato = $resultado->fetch_assoc()) {
    $pdf->Cell(30, 10, $dato['proveedor'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $dato['codigo'], 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $dato['descripcion'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $dato['precio'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $dato['existencia'], 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $dato['fecha'], 1, 1, 'C', 0);
}
$pdf->Output();
