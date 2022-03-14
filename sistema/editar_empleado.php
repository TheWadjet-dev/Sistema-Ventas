<?php
include "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['rol'])) {
    $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
  } else {
    $idusuario = $_GET['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $foto = addslashes(file_get_contents($_FILES['foto']['tmp_name']));

    $sql_update = mysqli_query($conexion, "UPDATE usuario SET nombre = '$nombre', correo = '$correo', rol = '$rol', foto = '$foto' WHERE idusuario = $idusuario");
    $alert = '<div class="alert alert-success" role="alert">Usuario Actualizado</div>';
  }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_usuarios.php");
}
$idusuario = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE idusuario = $idusuario");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_usuarios.php");
} else {
  if ($data = mysqli_fetch_array($sql)) {
    $idcliente = $data['idusuario'];
    $nombre = $data['nombre'];
    $correo = $data['correo'];
    $rol = $data['rol'];
    $foto = $data['foto'];
  }
}
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header bg-primary">
          Modificar Usuario
        </div>
        <div class="card-body">
          <form class="" action="" enctype="multipart/form-data" method="post">
            <?php echo isset($alert) ? $alert : ''; ?>
            <input type="hidden" name="id" value="<?php echo $idusuario; ?>">
            <div class="form-group">
              <label for="foto">Foto</label>
              <img height="80px" src="data:image/jpg;base64, <?php echo base64_encode($data['foto']) ?>">
              <input type="file" required class="form-control" placeholder="Agregue una foto" name="foto" id="foto" />
            </div>
            <div class="form-group">
              <label for="nombre">Nombre y Apellido</label>
              <input type="text" placeholder="Ingrese nombre" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">

            </div>
            <div class="form-group">
              <label for="correo">Correo</label>
              <input type="text" placeholder="Ingrese correo" class="form-control" name="correo" id="correo" value="<?php echo $correo; ?>">

            </div>
            <div class="form-group">
              <label for="rol">Rol</label>
              <select name="rol" id="rol" class="form-control">
                <option value="1" <?php
                                  if ($rol == 1) {
                                    echo "selected";
                                  }
                                  ?>>Administrador</option>
                <option value="2" <?php
                                  if ($rol == 2) {
                                    echo "selected";
                                  }
                                  ?>>Vendedor</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Usuario</button>
            <div><a href="index.php" class="btn btn-danger">Regresar</a></div>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- /.container-fluid -->
<?php include_once "includes/footer.php"; ?>