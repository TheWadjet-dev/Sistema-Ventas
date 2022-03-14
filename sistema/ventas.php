<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Ventas</h1>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<a href="GR_Pedidos.php" class="btn btn-danger" target="_blank">Generar Reporte</a>
			<form action="limpiar.php" class="confirmar d-inline">
				<button class="btn btn-danger" type="submit">Limpiar </button>
			</form>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="table">
				<thead class="thead-dark">
					<tr>
						<th>Id</th>
						<th>Fecha</th>
						<th>Total</th>
						<?php if ($_SESSION['rol'] == 1) { ?>
							<th>Acciones</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
					require "../conexion.php";
					$query = mysqli_query($conexion, "SELECT * FROM factura ORDER BY nofactura DESC");
					$cli = mysqli_num_rows($query);

					if ($cli > 0) {
						while ($dato = mysqli_fetch_array($query)) { ?>
							<tr>
								<td><?php echo $dato['nofactura']; ?></td>
								<td><?php echo $dato['fecha']; ?></td>
								<td><?php echo $dato['totalfactura']; ?></td>
								<?php if ($_SESSION['rol'] == 1) { ?>
									<td>
										<a class="btn btn-primary view_factura" cl="<?php echo $dato['codcliente'];  ?>" f="<?php echo $dato['nofactura']; ?>">Ver</a>


									</td>
								<?php } ?>
							</tr>
					<?php }
					} ?>
				</tbody>
			</table>
			<a href="index.php" class="btn btn-primary">Regresar</a>
		</div>
	</div>
</div>



</div>
<!-- /.container-fluid -->

<?php include_once "includes/footer.php"; ?>