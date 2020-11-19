<?php
include_once 'conexion.php';

$sentencia_select = $conn->prepare('SELECT concepto, costo FROM costos');
$sentencia_select->execute();
$resultado = $sentencia_select->fetchAll();


$sentencia_select = $conn->prepare('SELECT concepto, costo FROM activo WHERE categoria = "Activo Fijo"');
$sentencia_select->execute();
$resultadoAF = $sentencia_select->fetchAll();

$sentencia_select = $conn->prepare('SELECT concepto, costo FROM activo WHERE categoria = "Activo Circulante"');
$sentencia_select->execute();
$resultadoAC = $sentencia_select->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
	<title>Balance</title>
	<link rel="stylesheet" href="bootstrap.css">
	<script src="jquery-3.5.1.min.js"></script>
	<script src="plotly-latest.min.js"></script>
	<link rel="stylesheet" href="css/estilos.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						<h2>Graficas de Barras</h2>
						</br>
					</div>
					<div class="panel panel-body ">
						<div class="row">

							<!--Activos Circulante-->
							<div class="col-sm-6">
								<div>

									<table>
										<thead>
											<h3>Activos Circulante</h3>
											<tr>
												<th>Concepto</th>
												<th>Costo</th>
											</tr>
										</thead>
										<tbody>

											<?php foreach ($resultadoAC as $fila) : ?>
												<tr>
													<td><?php echo $fila['concepto']; ?></td>
													<td><?php echo $fila['costo']; ?></td>
												</tr>
											<?php endforeach ?>



										</tbody>
									</table>
								</div>
							</div>


							<!--Pasivo Fijo-->
							<div class="col-sm-6">
								<div class="contenedor">
									<table>
										<thead>
											<h3>Pasivos Fijo</h3>
											<tr>
												<th>Concepto</th>
												<th>Costo</th>
											</tr>
										</thead>
										<tbody>

											<?php foreach ($resultado as $fila) : ?>
												<tr>
													<td><?php echo $fila['concepto']; ?></td>
													<td><?php echo $fila['costo']; ?></td>
												</tr>
											<?php endforeach ?>



										</tbody>

									</table>
								</div>
							</div>






							<!--ACTIVO FIJO-->
							<div class="col-sm-6">
								<div>
									<table>
										<thead>
											<h3>Activos Fijos</h3>
											<tr>
												<th>Concepto</th>
												<th>Costo</th>
											</tr>
										</thead>
										<tbody>

											<?php foreach ($resultadoAF as $fila) : ?>
												<tr>
													<td><?php echo $fila['concepto']; ?></td>
													<td><?php echo $fila['costo']; ?></td>
												</tr>
											<?php endforeach ?>



										</tbody>
									</table>
								</div>

							</div>

							<!--Pasivo Circualnte -->
							<div class="col-sm-6">
								<div class="contenedor">
									<table>
										<thead>
											<h3>Pasivos Circulante</h3>
											<tr>
												<th>Concepto</th>
												<th>Costo</th>
											</tr>
										</thead>
										<tbody>

											<?php foreach ($resultado as $fila) : ?>
												<tr>
													<td><?php echo $fila['concepto']; ?></td>
													<td><?php echo $fila['costo']; ?></td>
												</tr>
											<?php endforeach ?>



										</tbody>

									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						<h2>Graficas de Barras</h2>
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-6">
								<div id="cargaLineal"></div>
							</div>
							<div class="col-sm-6">
								<div id="cargaBarras"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>

</html>
<script type="text/javascript">
	$(document).ready(function() {
		$('#cargaLineal').load('Graficas/BarrasA.php');
		$('#cargaBarras').load('Graficas/barras.php');
	});
</script>