<?php 
 
 session_start();

 include "../conexion.php";
  
 function contarRegistros($conection, $tabla, $estatus) {
    $query = mysqli_query($conection, "SELECT * FROM `$tabla` WHERE estatus = $estatus");
    return mysqli_num_rows($query);
}

$cant_usuarios_activos = contarRegistros($conection, 'usuario', 1);
$cant_usuarios_inactivos = contarRegistros($conection, 'usuario', 0);
$cant_clientes_activos = contarRegistros($conection, 'cliente', 1);
$cant_clientes_inactivos = contarRegistros($conection, 'cliente', 0);
$cant_proveedores_activos = contarRegistros($conection, 'proveedor', 1);
$cant_proveedores_inactivos = contarRegistros($conection, 'proveedor', 0);
$cant_productos_activos = contarRegistros($conection, 'producto', 1);

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
		<h1 class="dashboard_titulo">Bienvenido <?php echo $_SESSION['user']?></h1>
		<h2 class="dashboard_subtitulo">Dashboard</h2>
		<div class="dashboard">
			<div class="dashboard_1">
				<div class="usuarios items">
					<h2><a href="lista_usuarios.php">Usuarios</a></h2>

					<p class="items_text">activos: <span><?php echo $cant_usuarios_activos; ?></span></p>
					<p class="items_text">Inactivos: <span><?php echo $cant_usuarios_inactivos; ?></span></p>
					<p class="items_text">Total: <span><?php echo ($cant_usuarios_inactivos + $cant_usuarios_activos); ?></span></p>
				</div>

				<div class="clientes items ">
					<h2><a href="#">Clientes</a></h2>
					<p class="items_text">Activos: <span><?php echo $cant_clientes_activos; ?></span></p>
					<p class="items_text">Inactivos: <span><?php echo $cant_clientes_inactivos; ?></span></p>
				</div>
				<div class="proveedores items">
					<h2><a href="#">Proveedores</a></h2>
					<p class="items_text">Activos: <span><?php echo $cant_proveedores_activos; ?></span></p>
					<p class="items_text">Inactivos: <span><?php echo $cant_proveedores_inactivos; ?></span></p>
				</div>
			</div>
			<div class="dashboard_2">
				<div class="productos items">
					<h2><a href="#">Productos</a></h2>
					<p class="items_text">Productos Activos: <span><?php echo $cant_productos_activos; ?></span></p>
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