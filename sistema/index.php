<?php 
 
 session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<h1>Bienvenido al sistema</h1>
		<h2>Dashboard</h2>
		<div class="dashboard">
			<div class="dashboard_1">
				<div class="usuarios">
					<h2><a href="lista_usuarios.php">Usuarios</a></h2>
					<p>activos: <span>4</span></p>
					<p>Inactivos: <span>0</span></p>
				</div>

				<div class="clientes">
					<h2><a href="#">Clientes</a></h2>
					<p>Cantidad de Clientes: <span>1</span></p>
				</div>
			</div>
			<div class="dashboard_2">
				<div class="productos">
					<h2><a href="#">Productos</a></h2>
					<p>Productos Activos: <span>100</span></p>
					<p>Productos Inactivos: <span>0</span></p>
				</div>

				<div class="facturacion">
					<h2><a href="#">Balance</a></h2>
					<p>Facturacion del dia: <span>$29390</span></p>
					<p>Gastos del dia: <span>$29390</span></p>
					<p>Pagos en Efectivos: <span>$32029</span></p>
					<p>Pagos con debito: <span>$32029</span></p>
					<p>Pagos con Credito: <span>$32029</span></p>
				</div>
			</div>
		</div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>