<?php
require("../conexion.php");
$sql = "TRUNCATE factura";
$conexion->query($sql);

$nofactura = $conexion->query("SELECT * FROM factura");

if (count($nofactura->fetch_all()) == 0) {
    echo "No hay ninguna dato.";
}

mysqli_close($conexion);
header("location: ventas.php");
