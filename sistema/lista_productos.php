<?php include_once "includes/header.php"; ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<script src="JsBarcode.all.min.js"></script>
	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Productos</h1>
	</div>

	<div class="row">
		<div class="col-lg-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>CODIGO DE BARRAS</th>
							<th>PRODUCTO</th>
							<th>PRECIO</th>
							<th>STOCK</th>
							<th>CATEGORIA</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
								<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT * FROM producto");
						$result = mysqli_num_rows($query);
						$arrayCodigos = array();

						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) {
								$arrayCodigos[] = (string)$data['codigo'];
						?>
								<tr>
									<td><?php echo $data['codproducto']; ?></td>
									<td>
										<svg id='<?php echo "codigo" . $data['codigo']; ?>'></svg>
									</td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><?php echo $data['precio']; ?></td>
									<td><?php echo $data['existencia']; ?></td>
									<td><?php echo $data['categoria']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
										<td>
											<a href="agregar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-primary"><i class='fas fa-audio-description'></i></a>

											<a href="editar_producto.php?id=<?php echo $data['codproducto']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

											<form action="eliminar_producto.php?id=<?php echo $data['codproducto']; ?>" method="post" class="confirmar d-inline">
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
		<script type="text/javascript">
			function arrayjsoncodigo(j) {
				json = JSON.parse(j);
				arr = [];
				for (var x in json) {
					arr.push(json[x]);
				}
				return arr;
			}

			jsonvalor = '<?php echo json_encode($arrayCodigos) ?>';
			valores = arrayjsoncodigo(jsonvalor);

			for (var i = 0; i < valores.length; i++) {

				JsBarcode("#codigo" + valores[i], valores[i].toString(), {
					format: "codabar",
					lineColor: "#000",
					width: 2,
					height: 25
				});
			}
		</script>
	</div>

</div>
<!-- /.container-fluid -->


<?php include_once "includes/footer.php"; ?>