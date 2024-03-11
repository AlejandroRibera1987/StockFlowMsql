<?php
    session_start();

    include "../conexion.php";

    if(!empty($_POST))
    {
        $alert = '';

        if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']))
        {
            $alert ='<p class="msg_error">Nombre, Telefono y Direccion son Obligatorios.</p>';
        }else{
            
                $dni = $_POST['dni'];
                $nombre = $_POST['nombre'];
                $email = $_POST['correo'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $usuario_id = $_SESSION['idUser'];

                $result = 0;

                if(is_numeric($dni))
                {
                    $query = mysqli_query($conection, "SELECT * FROM cliente WHERE dni = '$dni'");
                    $result = mysqli_fetch_array($query);
                }

                if($result > 0 ) 
                {
                    $alert ='<p class="msg_error">El numero de DNI ya Existe</p>';
                }else{
                    $query_insert = mysqli_query($conection, "INSERT INTO cliente(dni,nombre,telefono,correo, direccion, usuario_id)
                                                            VALUE ('$dni','$nombre','$telefono','$email', '$direccion', '$usuario_id')");
                    if($query_insert)
                    {
                        $alert ='<p class="msg_save">Cliente Creado Correctamente</p>';
                    }else{
                        $alert ='<p class="msg_error">Error al crear el Cliente</p>';
                    }
                }
            }
                mysqli_close($conection);
            
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Registro Cliente</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="form_register">
            <h1>Registro Cliente</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert:''; ?>
            </div>

            <form action="" method="post">
                <label for="dni">DNI</label>
                <input type="number" name="dni" id="dni" placeholder="Numero de DNI">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                <label for="correo">Correo Electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
                <label for="telefono">Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección">
                
                <input type="submit" value="Guardar Cliente" class="btn_save">
            </form>
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>