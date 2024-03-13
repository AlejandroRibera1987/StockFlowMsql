<?php
  

  if(empty($_SESSION['active']))
  {
    header('location: ../');
  }


?>
<script>
// Función para actualizar la hora cada segundo
function actualizarHora() {
    var fecha = new Date();
    var hora = fecha.getHours();
    var minutos = fecha.getMinutes();
    var segundos = fecha.getSeconds();

    // Agregar un cero delante de los números menores de 10
    hora = (hora < 10 ? "0" : "") + hora;
    minutos = (minutos < 10 ? "0" : "") + minutos;
    segundos = (segundos < 10 ? "0" : "") + segundos;

    // Construir la cadena de la hora actual
    var hora_actual = hora + ":" + minutos + ":" + segundos;

    // Mostrar la hora actual en el elemento con id "hora_actual"
    document.getElementById("hora_actual").innerHTML = hora_actual;
}

// Actualizar la hora cada segundo
setInterval(actualizarHora, 1000);
</script>

<header>
		<div class="header">
			
			<h1>StockFlow</h1>
			<div class="optionsBar">
				<p>Argentina, <?php echo fechaC(); ?></p>
				<span>|</span>
				<p id="hora_actual"><?php echo date("H:i:s"); ?></p>
				<span>|</span>
				<span class="user"><?php echo $_SESSION['user'].'-'.$_SESSION['rol']; ?></span>
				<img class="photouser" src="img/user1.png" alt="Usuario">
				<a href="salir.php"><img class="close" src="img/salir2.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>
    <?php include "nav.php" ?>
</header>
