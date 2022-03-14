<?php
include "../conexion.php";
$alert = '';
$txtci = $_POST['txtci'];
$txtNombre = $_POST['txtNombre'];
$txtRSocial = $_POST['txtRSocial'];
$txtTelefono = $_POST['txtTelEmpresa'];
$txtDireccion = $_POST['txtDirEmpresa'];
$txtemail = $_POST['txtEmailEmpresa'];
$txtIVA = $_POST['txtIVA'];
$actualizar_empresa = mysqli_query($conexion, "UPDATE configuracion SET ci = $txtci, nombre = '$txtNombre', razon_social = '$txtRSocial', telefono = $txtTelefono, email = '$txtemail', direccion = '$txtDireccion', IVA = $txtIVA");
mysqli_close($conexion);
if ($actualizar_empresa) {
  $alert = '<p class="msg_save">Configuración de empresa Actualizado</p>';
  header("Location: index.php");
} else {
  $alert = '<p class="msg_error">Error al Actualizar la Configuración de empresa</p>';
}
?>
 <?php
  include "includes/footer.php";
  ?>
 
