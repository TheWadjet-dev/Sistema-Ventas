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

        $this->Cell(30, 10, 'ID', 1, 0, 'C', 0);
        $this->Cell(80, 10, 'Nombre y Apellido', 1, 0, 'C', 0);
        $this->Cell(80, 10, 'Correo', 1, 1, 'C', 0);
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
$consulta = "SELECT * FROM usuario";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

while ($dato = $resultado->fetch_assoc()) {
    $pdf->Cell(30, 10, $dato['idusuario'], 1, 0, 'C', 0);
    $pdf->Cell(80, 10, $dato['nombre'], 1, 0, 'C', 0);
    $pdf->Cell(80, 10, $dato['correo'], 1, 1, 'C', 0);
}
$pdf->Output();
