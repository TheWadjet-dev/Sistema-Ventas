<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Empleados</h1>
		<?php if ($_SESSION['rol'] == 1) { ?>
			<a href="registro_empleado.php" class="btn btn-primary">Nuevo</a>
		<?php } ?>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<div><a href="reporte_empleados.php" class="btn btn-danger" target="_blank">Generar Reporte</a></div>
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>FOTO</th>
							<th>NOMBRE</th>
							<th>CORREO</th>
							<th>DIRECCIÓN</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
								<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT u.idusuario, u.nombre, u.correo, r.rol, u.foto FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['idusuario']; ?></td>
									<td>
										<center><img height="50px" src="data:image/jpg;base64, <?php echo base64_encode($data['foto']) ?>"></center>
									</td>
									<td><?php echo $data['nombre']; ?></td>
									<td><?php echo $data['correo']; ?></td>
									<td><?php echo $data['rol']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
										<td>
											<a href="editar_empleado.php?id=<?php echo $data['idusuario']; ?>" class="btn btn-success"><i class='fas fa-edit'></i> Editar</a>
											<form action="eliminar_empleado.php?id=<?php echo $data['idusuario']; ?>" method="post" class="confirmar d-inline">
												<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
											</form>
										</td>
									<?php } ?>
								</tr>
						<?php }
						} ?>
					</tbody>
				</table>
			</div>
			<div><a href="index.php" class="btn btn-danger">Regresar</a></div>
		</div>
	</div>


</div>
<!-- /.container-fluid -->


<?php include_once "includes/footer.php"; ?>