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
		<h1 class="dashboard_titulo">Bienvenide <?php echo $_SESSION['user']?></h1>
		<h2 class="dashboard_subtitulo">Dashboard</h2>
		<div class="dashboard">
			<div class="dashboard_1">
				<div class="usuarios items">
					<h2><a href="lista_usuarios.php">Usuarios</a></h2>
					<p class="items_text">activos: <span>4</span></p>
					<p class="items_text">Inactivos: <span>0</span></p>
				</div>

				<div class="clientes items ">
					<h2><a href="#">Clientes</a></h2>
					<p class="items_text">Activos: <span>1</span></p>
					<p class="items_text">Inactivos: <span>1</span></p>
				</div>
				<div class="proveedores items">
					<h2><a href="#">proveedores</a></h2>
					<p class="items_text">Activos: <span>12</span></p>
					<p class="items_text">Inactivos: <span>1</span></p>
				</div>
			</div>
			<div class="dashboard_2">
				<div class="productos items">
					<h2><a href="#">Productos</a></h2>
					<p class="items_text">Productos Activos: <span>100</span></p>
					<p class="items_text">Productos con bajo Stock: <span>2</span></p>
					<p class="items_text">Productos Inactivos: <span>0</span></p>
				</div>

				<div class="facturacion items">
					<h2><a href="#">Balance</a></h2>
					<p class="items_text">Facturacion del dia: <span>$29390</span></p>
					<p class="items_text">Gastos del dia: <span>$29390</span></p>
					<p class="items_text">Pagos en Efectivos: <span>$32029</span></p>
					<p class="items_text">Pagos con debito: <span>$32029</span></p>
					<p class="items_text">Pagos con Credito: <span>$32029</span></p>
				</div>
			</div>
		</div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>