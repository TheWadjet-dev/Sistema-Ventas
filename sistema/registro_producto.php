 <?php include_once "includes/header.php";
  include "../conexion.php";
  if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <  0 || empty($_POST['cantidad'] || $_POST['categoria'] <  0)) {
      $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
    } else {
      $codigo = $_POST['codigo'];
      $proveedor = $_POST['proveedor'];
      $producto = $_POST['producto'];
      $precio = $_POST['precio'];
      $cantidad = $_POST['cantidad'];
      $categoria = $_POST['categoria'];
      $fecha = $_POST['fecha'];
      $usuario_id = $_SESSION['idUser'];

      $query_insert = mysqli_query($conexion, "INSERT INTO producto(codigo, proveedor,descripcion,precio,existencia, categoria, fecha ,usuario_id) values ('$codigo','$proveedor', '$producto', '$precio', '$cantidad', '$categoria', '$fecha','$usuario_id')");
      if ($query_insert) {
        $alert = '<div class="alert alert-success" role="alert">
                Producto Registrado
              </div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
      }
    }
  }
  ?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
     <h1 class="h3 mb-0 text-gray-800">Registro de Productos</h1>
     <a href="index.php" class="btn btn-primary">Regresar</a>
   </div>

   <!-- Content Row -->
   <div class="row">
     <div class="col-lg-6 m-auto">
       <div class="card">
         <div class="card-header bg-primary">
           Nuevo Producto
         </div>
         <div class="card-body">
           <form action="" method="post" autocomplete="off">
             <?php echo isset($alert) ? $alert : ''; ?>
             <div class="form-group">
               <label for="codigo">Código de Barras</label>
               <input type="text" placeholder="Ingrese código de barras" name="codigo" id="codigo" class="form-control">
             </div>
             <div class="form-group">
               <label>Proveedor</label>
               <?php
                $query_proveedor = mysqli_query($conexion, "SELECT codproveedor, proveedor FROM proveedor ORDER BY proveedor ASC");
                $resultado_proveedor = mysqli_num_rows($query_proveedor);
                mysqli_close($conexion);
                ?>

               <select id="proveedor" name="proveedor" class="form-control">
                 <?php
                  if ($resultado_proveedor > 0) {
                    while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                      // code...
                  ?>
                     <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                 <?php
                    }
                  }
                  ?>
               </select>
             </div>
             <div class="form-group">
               <label for="producto">Producto</label>
               <input type="text" placeholder="Ingrese nombre del producto" name="producto" id="producto" class="form-control">
             </div>
             <div class="form-group">
               <label for="precio">Precio</label>
               <input type="text" placeholder="Ingrese precio" class="form-control" name="precio" id="precio">
             </div>
             <div class="form-group">
               <label for="cantidad">Cantidad</label>
               <input type="number" placeholder="Ingrese cantidad" class="form-control" name="cantidad" id="cantidad">
             </div>
             <div class="form-group">
               <label for="cantidad">Categoria</label>
               <input type="text" placeholder="Ingrese la categoria" class="form-control" name="categoria" id="categoria">
             </div>
             <div class="form-group">
               <label for="fecha">Fecha de Ingreso</label>
               <input type="date" placeholder="Ingrese la fecha" class="form-control" name="fecha" id="fecha">
             </div>
             <input type="submit" value="Guardar Producto" class="btn btn-primary">
           </form>
         </div>
       </div>
     </div>
   </div>


 </div>
 <!-- /.container-fluid -->
 <?php include_once "includes/footer.php"; ?>