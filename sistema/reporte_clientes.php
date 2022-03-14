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
        $this->Cell(70, 10, 'Reporte Clientes', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(30, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'CI', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'Nombre y Apellido', 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Telefono', 1, 0, 'C', 0);
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
$consulta = "SELECT * FROM cliente";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

while ($dato = $resultado->fetch_assoc()) {
    $pdf->Cell(30, 10, $dato['idcliente'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $dato['ci'], 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $dato['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $dato['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(40, 10, $dato['direccion'], 1, 1, 'C', 0);
}
$pdf->Output();
