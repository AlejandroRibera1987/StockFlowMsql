<?php
    session_start();

include "../conexion.php";

    if(!empty($_POST))
    {
        $alert = '';

        if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']))
        {
            $alert ='<p class="msg_error">Todos los Campos son Obligatorios</p>';
        }else{
            
            $idCliente = $_POST['id'];
            $dni = $_POST['dni'];
            $email = $_POST['correo'];
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $result = 0;

            if(is_numeric($dni) and $dni != 0)
            {
                $query = mysqli_query($conection, "SELECT * FROM cliente
                                                    WHERE (dni = '$dni' AND idcliente != $idCliente)
                                                    ");
                $result = mysqli_fetch_array($query);
                if ($result !== null) {
                    $result = count($result);
                } else {
                    $result = 0; // O cualquier otro valor predeterminado que desees asignar
                }
            
                if($result > 0)
                {
                    $alert ='<p class="msg_error">El DNI ya Existe</p>';
                }
            }

            if($result > 0)
            {
                $alert ='<p class="msg_error">El DNI ya Existe</p>';
            }else{

                if($dni == '')
                {
                    $dni = 0;
                }

                    $sql_update = mysqli_query($conection, " UPDATE cliente
                                                                SET dni = $dni, correo = '$email', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion'
                                                                WHERE idcliente = $idCliente ");
                

                if($sql_update)
                {
                    $alert ='<p class="msg_save">Exito al Actualizar Cliente.</p>';                 
                }else{
                    $alert ='<p class="msg_error">Error al Actualizar Cliente.</p>';
                }
                
            }
        }
       // mysqli_close($conection);
    }

    //Mostrar Datos
    if(empty($_GET['id']))
    {
        header('location: lista_clientes.php');
        mysqli_close($conection);
    }
    $idcliente = $_GET['id'];

    $sql = mysqli_query($conection, "SELECT * FROM cliente
                                        WHERE idcliente = $idcliente and estatus = 1");

    mysqli_close($conection);
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0)
    {
        header('location: lista_clientes.php');
    }else{
      
        while($data = mysqli_fetch_array($sql)) 
        {
            $idcliente = $data['idcliente'];
            $dni = $data['dni'];
            $nombre = $data['nombre'];
            $telefono = $data['telefono'];
            $correo = $data['correo'];
            $direccion = $data['direccion'];

        }
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Editar Cliente</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="form_register">
            <h1>Editar Cliente</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert:''; ?>
            </div>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $idcliente?>">
                <label for="dni">DNI</label>
                <input type="number" name="dni" id="dni" placeholder="Numero de DNI" value = "<?php echo $dni?>">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value = "<?php echo $nombre?>">
                <label for="correo">Correo Electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico" value = "<?php echo $correo?>">
                <label for="telefono">Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono" value = "<?php echo $telefono?>">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección" value = "<?php echo $direccion?>">
                
                <input type="submit" value="Actualizar Cliente" class="btn_save">
            </form>
           
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>