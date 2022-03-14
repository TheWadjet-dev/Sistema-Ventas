<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Ventas</h1>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div><a href="GR_Compras.php" class="btn btn-danger" target="_blank">Generar Reporte</a></div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>Proveedor</th>
							<th>Codigo de Barras</th>
							<th>Producto</th>
							<th>Precio Compra</th>
							<th>Cantidad</th>
							<th>Fecha de Ingreso</th>
						</tr>
					</thead>
					<tbody>
						<?php
						require "../conexion.php";
						$query = mysqli_query($conexion, "SELECT descripcion, codigo, precio, existencia, fecha FROM producto");
						$query2 = mysqli_query($conexion, "SELECT proveedor FROM proveedor");
						mysqli_close($conexion);
						$cli = mysqli_num_rows($query);
						$cli2 = mysqli_num_rows($query2);

						if ($cli > 0 && $cli2 > 0) {
							$dato2 = mysqli_fetch_array($query2);
							while ($dato = mysqli_fetch_array($query)) {
						?>
								<tr>
									<td><?php echo $dato2['proveedor']; ?></td>
									<td><?php echo $dato['codigo']; ?></td>
									<td><?php echo $dato['descripcion']; ?></td>
									<td><?php echo $dato['precio']; ?></td>
									<td><?php echo $dato['existencia']; ?></td>
									<td><?php echo $dato['fecha']; ?></td>
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

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>