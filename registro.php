<?php
//sql
include "./conexion.php";
include "./sistema/includes/functions.php";

if (!empty($_SESSION['active'])) {
    header('location: sistema/');
} else {
    if (!empty($_POST)) {
        if (empty($_POST['nombre']) || empty($_POST['clave']) || empty($_POST['correo']) || empty($_POST['rol'])) {
            $alert = '<div class="alert alert-danger" role="alert">
  Algun campo esta vacio
</div>';
        } else {
            $nombre = $_POST['nombre'];
            $email = $_POST['correo'];
            $clave = md5($_POST['clave']);
            $rol = $_POST['rol'];
            $query = mysqli_query($conexion, "SELECT * FROM usuario where correo = '$email'");
            $result = mysqli_fetch_array($query);

            if ($result > 0) {
                $alert = '<div class="alert alert-danger" role="alert">
                        El correo ya existe
                    </div>';
            } else {
                $query_insert = mysqli_query($conexion, "INSERT INTO usuario(nombre,correo,clave,rol) values ('$nombre', '$email', '$clave', '$rol')");
                if ($query_insert) {
                    $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
                        </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                        Error al registrar
                    </div>';
                }
            }
        }
    }
}


//firebase
$data = '{"nombre":$nombre,}';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://www.google.com/recaptcha/api.js?render=6Le6IEMeAAAAAF6zpbtSIqYv0jLH_O-FWCMJKXAz"></script>
    <script>
        function onClick(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('6Le6IEMeAAAAAF6zpbtSIqYv0jLH_O-FWCMJKXAz', {
                    action: 'validarusuario'
                }).then(function(token) {

                });
            });
        }
    </script>
    <title>Candy Planet</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="sistema/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Custom styles for this template-->
    <link href="sistema/css/sb.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">

                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registro de Cuenta</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <?php echo isset($alert) ? $alert : ""; ?>
                                        <div class="form-group">
                                            <label for="">Nombre y Apellido</label>
                                            <input type="text" class="form-control" placeholder="Nombre y Apellido" name="nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="password" class="form-control" placeholder="Contraseña" name="clave">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Correo</label>
                                            <input type="text" class="form-control" placeholder="Correo" name="correo">
                                        </div>
                                        <div class="form-group">
                                            <label>Rol</label>
                                            <select name="rol" id="rol" class="form-control">
                                                <?php
                                                $query_rol = mysqli_query($conexion, " select * from rol");
                                                mysqli_close($conexion);
                                                $resultado_rol = mysqli_num_rows($query_rol);
                                                if ($resultado_rol > 0) {
                                                    while ($rol = mysqli_fetch_array($query_rol)) {
                                                ?>
                                                        <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
                                                <?php

                                                    }
                                                }

                                                ?>
                                            </select>
                                        </div>
                                        <input type="submit" value="Registrarse" class="btn btn-primary">
                                        <a href="inicio_sesion.php" class="btn btn-danger">Regresar</a>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="sistema/vendor/jquery/jquery.min.js"></script>
    <script src="sistema/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="sistema/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="sistema/js/sb-admin-2.min.js"></script>

</body>

</html>